$(function(){

    Backbone.emulateHTTP = Backbone.emulateJSON = true;

    // models

    // global model with general properties
    oms = new (Backbone.Model.extend({
        gridId          : '#oms-grid-view0',
        sortSelector    : '.sort-link',
        attributeLabels : {
            'User Name'     : 'username',
            'First Name'    : 'firstname',
            'Last Name'     : 'lastname',
            'Role'          : 'role',
            'Email'         : 'email',
            'Region'        : 'region'
        },
        fetchOptions: {
            reset: true,
            error: function(collection, response, options) {
                if ( response.status == 403 ) {
                    window.location.href = "";
                } else {
                    alert("Error: " + response.status + " " + response.responseText);
                    $(oms.gridId).removeClass('grid-view-loading');
                }
            }
        },
        initialize: function() {
            var relUrl = $('#base-url').text();
            this.indexUrl = window.location.protocol + '//' 
                + window.location.hostname + relUrl;
            this.historyRoot = relUrl + '/admin/index/';
        }
    }));
    
    // model representing all nonstatic data on the page, except row
    oms.fields = new (Backbone.Model.extend({
        nextPageSize: 25,
        pageSizes: {25: 10, 10: 25},
        userCount     : 0,
        totalPages    : 1,
        queryString   : '',
        showDel       : 0,
        pageSize      : 0,
        sort          : '',
        page          : 1,
        filterField   : 0,
        filterCriteria: 0,
        filterValue   : '',
        buttons: {
            First:    {
                enabled:false,
                cssClass:'first',
                getPageNumber: function() {
                    return 1;
                }
            },
            Backward: {
                enabled:false,
                cssClass:'backward',
                getPageNumber: function() {
                    return oms.fields.page-1;
                }
            },
            Forward:  {
                enabled:false,
                cssClass:'forward',
                getPageNumber: function() {
                    return parseInt(oms.fields.page) + 1;
                }
            },
            Last:     {
                enabled:false,
                cssClass:'last',
                getPageNumber: function() {
                    return oms.fields.totalPages;
                }
            }
        },
        setButtons: function() {
            // calculating total pages (userCount is set after reseting collection)
            var newTotalPages = Math.ceil(this.userCount/this.pageSizes[this.nextPageSize]);
            newTotalPages = newTotalPages || 1;

            this.totalPages = newTotalPages;
            if ( this.page > newTotalPages ) {
                this.page = newTotalPages;
            }

            // updating state of buttons with respect to new current and total pages
            this.buttons.First.enabled = this.buttons.Backward.enabled
                = (this.page > 1);
    
            this.buttons.Last.enabled = this.buttons.Forward.enabled 
                = (this.page < this.totalPages);
        },
        // part of url with get parameters
        makeString: function() {
            this.queryString = '';
            if ( this.showDel ) {
                this.queryString += '/showDel/1';
            }
            if ( this.pageSize ) {
                this.queryString += '/pageSize/' + this.pageSize;
            }
            if ( this.sort ) {
                this.queryString += '/User_sort/' + this.sort;
            }
            if ( this.page ) {
                this.queryString += '/User_page/' + this.page;
            }
            if ( this.filterValue ) {
                this.queryString += '/AdminSearchForm%5BkeyField%5D/' + this.filterField
                    + '/AdminSearchForm%5Bcriteria%5D/' + this.filterCriteria
                    + '/AdminSearchForm%5BkeyValue%5D/' + encodeURI(this.filterValue);
            }
            return this.queryString;
        }
    }));

    // model representing a row
    var User = Backbone.Model.extend({
        urlRoot: oms.indexUrl + '/admin/user/id',
        fetchUser: function(options) {
            var that = this;
            options = $.extend({silent: false}, options || {})
            //this.url = oms.indexUrl + '/admin/user/id/' + this.get("id");
            this.fetch({         
                success: function() {
                    if ( !options.silent ) {
                        that.trigger('user:fetched');
                    }
                    that.row.render();
                },
                error: function(model, response, options) {
                    if ( response.status == 403 ) {
                        window.location.href = "";
                    } else {
                        alert("Error: " + response.status + " " + response.responseText);
                    }
                }
            }).always(function(){
                $(oms.gridId).removeClass('grid-view-loading');
                userEditWindow.$('.edit-shade').removeClass('loading');
            });            
        }

    });

    // collection of rows
    var Users = Backbone.Collection.extend({
        model: User,
        initialize: function() { 
            this.on('request',function(model, xhr, options) {
                $(oms.gridId).addClass('grid-view-loading');
            });
            this.on('reset',function() {
                oms.fields.userCount = this.models[this.models.length-1].get("userCount");
    
                this.length = --(this.models.length);

                userTable.addAll();
                $(oms.gridId).removeClass('grid-view-loading');
            });
        },
    });

    oms.users = new Users;

    // views

    // row view
    var UserRow = Backbone.View.extend({

        tagName: "tr",
        template: _.template($('#row-template').html()),

        render: function(){
            var row = this.model.toJSON();
            row.active = !!row.active;
            row.deleted = row.deleted==1;
            row.root = oms.indexUrl;
            this.$el.html(this.template(row)); 

            if ( this.id%2 ) {
                this.$el.toggleClass('even',true);
            } else {
                this.$el.toggleClass('odd',true);
            }

            this.$el
                .toggleClass('user-deleted',row.deleted)
                .toggleClass('user-active', row.active);

            this.$el.find('a[title="remove"]').on(
                'click',
                {
                    modelId: row.id,
                },
                userTable.removeClick
            );
            this.$el.find('a[title="edit"]').on(
                'click', 
                {
                    modelId: row.id,
                    action: actionEdit, 
                    row: this
                },
                userTable.editClick
            );
            this.$el.find('a[title="duplicate"]').on(
                'click', 
                {
                    modelId: row.id,
                    action: actionDuplicate, 
                    row: this
                },
                userTable.editClick
            );

            return this;

        }
    });

    // table view
    var UserTable = Backbone.View.extend({
        
        el: $("#table-user"),

        showDeletedClick: function() {
            oms.fields.showDel = oms.fields.showDel==1 ? 0 : 1;
            router.navigate(oms.fields.makeString());
            oms.users.url = oms.indexUrl + '/admin/index' + oms.fields.queryString;
            oms.users.fetch(oms.fetchOptions);            
            return false;
        },

        searchFormSubmit: function(event) {
            if ( $("#AdminSearchForm_keyValue",this).val() ) {
                oms.fields.page = 1;
                oms.fields.filterField = $("#AdminSearchForm_keyField",this).val();
                oms.fields.filterCriteria = $("#AdminSearchForm_criteria",this).val();
                oms.fields.filterValue = $("#AdminSearchForm_keyValue",this).val();
                router.navigate(oms.fields.makeString());
                oms.users.url = oms.indexUrl + '/admin/index' + oms.fields.queryString;
                oms.users.fetch(oms.fetchOptions);            
            }
            return false;
        },

        searchFormReset: function(event, opts) {
            var options = {noop: false};
            $.extend(options, opts || {});
            
            document.getElementById('btn-search').disabled = true;
            
            if ( !options.noop ) {
                oms.fields.page = 1;
                oms.fields.filterValue = '';
                router.navigate(oms.fields.makeString());
                oms.users.url = oms.indexUrl + '/admin/index' + oms.fields.queryString;
                oms.users.fetch(oms.fetchOptions);
            }
        },

        pageSizeClick: function(event) {
            oms.fields.pageSize = oms.fields.nextPageSize;
            
            // updating model
            oms.fields.nextPageSize = oms.fields.pageSizes[oms.fields.nextPageSize];
            
            router.navigate(oms.fields.makeString());
            oms.users.url = oms.indexUrl + '/admin/index' + oms.fields.queryString;
            oms.users.fetch(oms.fetchOptions);            

            return false;
        },

        pageButtonClick: function(event) {
            if ( !$(this).hasClass('hidden') ) {
                var currentPage 
                    = oms.fields.buttons[$(this).text()].getPageNumber();
                oms.fields.page = currentPage;
                router.navigate(oms.fields.makeString());
                oms.users.url = oms.indexUrl + '/admin/index' + oms.fields.queryString;
                oms.users.fetch(oms.fetchOptions);            
            }
            return false;
        },

        sortLinkClick: function(event){
            if ( event.ctrlKey ) {
                var sortAdd = oms.attributeLabels[$(this).text()],
                    sortNow = oms.fields.sort;
                if ( sortNow ) {
                    // if we already sorted by some column
                    var sortAttr = sortNow.split('-');
                    var existingPos = sortAttr.indexOf(sortAdd);
                    if ( 0 <= existingPos ) {
                        // already sorted by given column asc
                        sortAdd += '.desc';
                        //sortAttr.splice(existingPos,1);
                        //sortAttr.push(sortAdd);
                        sortAttr[existingPos] = sortAdd;
                        sortNow = sortAttr.join('-');
                    } else {
                        existingPos = sortAttr.indexOf(sortAdd+'.desc');
                        if ( 0 <= existingPos ) {
                            // already sorted desc
                            sortAttr.splice(existingPos,1);
                            //sortAttr.push(sortAdd);
                            sortNow = sortAttr.join('-');
                        } else {
                            // have not sorted by a given column
                            sortNow = sortNow + '-' + sortAdd;
                        }
                    }    
                } else {
                    //have not sorted by either column
                    sortNow = sortAdd;
                }

                oms.fields.sort = sortNow;

                router.navigate(oms.fields.makeString());
                oms.users.url = oms.indexUrl + '/admin/index' + oms.fields.queryString;
                oms.users.fetch(oms.fetchOptions);            
    
            }
            return false;
        },

        removeClick: function(event){
            $('#confirm-deleting .btn-primary').attr('href', this.href);
            $('#confirm-deleting').modal();
            return false;
        },

        editClick: function(event) {
            var url = this.href,
                model = oms.users.get(event.data.modelId),
                prevAction = userEditWindow.action;
            userEditWindow.url = url;
            userEditWindow.action = event.data.action;
            model.row = event.data.row;
            userEditWindow.model = model;
            userEditWindow.listenTo(
                userEditWindow.model,
                'user:fetched',
                userEditWindow.render
            );
            userEditWindow.$('.edit-shade').addClass('loading');
            userEditWindow.modalShow();
            if ( prevAction == userEditWindow.action ) {
                model.fetchUser({silent:false});
            } else {
                model.fetchUser({silent:true});
                userEditWindow.loadForm();
            }

            return false;
        },

        createUserClick: function(){
            var url = this.href,
                prevAction = userEditWindow.action;
            userEditWindow.url = url;
            userEditWindow.action = actionCreate;
            userEditWindow.$('.edit-shade').addClass('loading');
            userEditWindow.modalShow();
            if ( prevAction == actionCreate ) {
                userEditWindow.render();
            } else {
                userEditWindow.loadForm();
            }

            return false;
        },
    
        initialize: function() { 
            $('#create-user').on('click', this.createUserClick);
            $('#check_toggle').on('change', this.showDeletedClick);
            $('#search-form').on('submit', this.searchFormSubmit);
            $('#search-form').on('reset', this.searchFormReset);
            $("#search-form #AdminSearchForm_keyValue").on('keyup', function(){
                $('#search-form #btn-search').prop('disabled',!this.value.length);
            });
            $("#page-size").on('click', this.pageSizeClick);
            $('ul.yiiPager li').on("click", this.pageButtonClick);
            $(oms.sortSelector).on('click', this.sortLinkClick);
            $('a.dropdown-toggle').on('click', function(e) {
                $('li.dropdown').toggleClass('open');
                e.stopPropagation();
                e.preventDefault();
                return false;
            });
            $(oms.sortSelector).css('cursor','default');
            $(document).on('keydown',function(e) {
                if ( e.ctrlKey ) {
                    $(oms.sortSelector).css('cursor','pointer');
                }
            });
            $(document).on('keyup',function(e) {
                if ( !e.ctrlKey ) {
                    $(oms.sortSelector).css('cursor','default');
                }
            });

            $('#confirm-deleting .btn-primary').on('click.oms', function() {
                oms.users.url = this.href + oms.fields.makeString();
                oms.users.fetch(oms.fetchOptions);
            });

        },

        render: function() {
            oms.fields.setButtons();            
            this.renderTotal();
            $("#check_toggle").prop("checked",oms.fields.showDel==1);
            this.renderHeader();
            this.renderFooter();
            $("#page-size").text("show "+oms.fields.nextPageSize+" items");
        },

        renderHeader: function() {
            if ( oms.fields.sort ) {
                var sortAttr = oms.fields.sort.split('-');
                this.$('th a').each(function(index) {
                    var $this = $(this),
                        attr = oms.attributeLabels[$this.text()];
                                   
                    if (0 <= sortAttr.indexOf(attr) ) {
                        $this.removeClass('desc').addClass('asc');
                    } else if (0 <= sortAttr.indexOf(attr+'.desc') ) {
                        $this.removeClass('asc').addClass('desc');                    
                    } else {
                        $this.removeClass('asc').removeClass('desc');                    
                    }
                });
            } else {
                this.$('th a').removeClass('asc').removeClass('desc');                    
            }
        },

        renderTotal: function() {
            $("#search-result-count").text(oms.fields.userCount);
        },
        renderFooter: function() {
            if ( oms.users.length > 0 ) {
                $(".summary").text("page #"+oms.fields.page
                        +" of "+oms.fields.totalPages).show();
                pager.render();
            } else {
                $(".summary").hide();
                pager.hide();
            }
        }, 
        addOne: function(useri, i) {
            var row = new UserRow({model: useri, id: i});
            this.$el.append(row.render().el);
        },
    
        addAll: function() {
            this.$("tr").filter(function(index){return index > 0;}).remove();
            if ( oms.users.length > 0 ) {
                oms.users.each(this.addOne, this);

            } else {
                this.addEmpty();                
            }
            this.render();
        },

        addEmpty: function() {
            this.$el.append('<tr><td class="empty" colspan="0"><span class="empty">No results found.</span></td></tr>');
        }
    });

    var UserEditWindow = Backbone.View.extend({
        el: $('#modal-editing'),
        model: new Backbone.Model,
        url: '',
        action: {},
        validatedForms: 0,
        modalShow: function() {
            var data = this.$el.data('modal');
            if ( data && data.isShown ) {
                data.isShown = false;
                this.$el.data('modal',data);
            }
            this.$el.modal('show');
        },
        modalHide: function() {
            var data = this.$el.data('modal');
            this.$el.data('modal',$.extend(data,{isShown: true}));
            this.$el.modal('hide');
        },
        saveClick: function() {
            var $form = userEditWindow.$('.modal-body form')
                ,data = ''
                ,validated = 0;

            $form.each(function() {
                if ( $(this).triggerHandler('submit') ) {
                    validated++;
                };
            });

            setTimeout(function(){
                if ( (userEditWindow.validatedForms + validated)==1 ) {
                    $form.each(function() {
                        data += (data=='' ? '' : '&') + $(this).serialize();
                    });
                    $.post(userEditWindow.url, data)
                        .done(userEditWindow.action.saveDone)
                        .fail(function(xhr, textStatus, errorThrown) {
                            if ( xhr.status == 403 ) {
                                window.location.href = "";
                            } else {
                                alert( "Error: " + xhr.status + " " + xhr.statusText );
                            }
                        });
                    userEditWindow.modalHide();
                    $(oms.gridId).addClass('grid-view-loading');
                }
                userEditWindow.validatedForms = 0;
            },600);

            return false;
        },
        cancelClick: function() {
            $('#cofirm-edit-cancel').modal('show');
            return false;
        },
        refreshClick: function() {
            userEditWindow.$('.edit-shade').addClass('loading');
            userEditWindow.action.refresh();
        },
        loadForm: function() {
            var that = this;
            //this.$('.edit-shade').addClass('loading');

            $.ajax({
                url: this.url,
                dataType: 'html',
                success: function(data, textStatus, jqXHR){
                    that.$('#modal-editing-body').html(data);

                    that.$('.submit-handler').click(function(e) {
                        that.validatedForms++;
                        e.preventDefault();
                        return false;
                    });
                    that.renderBrace();
                    that.$('*').on('hidden.bs.tooltip', function(event){
                        event.stopPropagation();
                    });
                    
                    that.$('#modal-editing-body').scrollTop(0);

                },
                error: function(xhr){
                    if ( xhr.status == 403 ) {
                        window.location.href = "";
                    } else {
                        alert( "Error: " + xhr.status + " " + xhr.statusText );
                    }
                }
            }).always(function(){
                that.$('.edit-shade').removeClass('loading');
            });
        },

        initialize: function() { 
            var $modalWindow = this.$el,
                that = this;
            $modalWindow.on('hidden.bs.modal',function(){
                $modalWindow.find('#modal-editing-body').scrollTop(0);
                that.stopListening();
                $('.modal-backdrop').remove();
            });
            $modalWindow.on('shown.bs.modal',function(){
                $modalWindow.find('#modal-editing-body').scrollTop(0);
            });

            $('#cofirm-edit-cancel').on('shown.bs.modal',function(){
                $('.modal-backdrop:last').insertBefore('#cofirm-edit-cancel');
            });
            $('#cofirm-edit-cancel').on('hidden.bs.modal',function(){
                $('.modal-backdrop').remove();
            });
            this.$('.edit-cancel-yes').click(function() {
                $('#cofirm-edit-cancel').prev('.modal-backdrop').remove();
            });
            this.$('.edit-cancel-not').click(function() {
                var shadow = $('.modal-backdrop:last').clone();
                $('#cofirm-edit-cancel').modal('hide');
                if ( !$('.modal-backdrop').length ) {
                    $('body').append(shadow);
                }
                return false;
            });

            this.$('#edit-save').click(this.saveClick);
            this.$('#edit-refresh').click(this.refreshClick);
            this.$('#edit-cancel').click(this.cancelClick);
            this.$('form').submit(false);

            this.$('.submit-handler').click(function() {
                that.validatedForms++;
                return false;
            });

        },
        renderBrace: function() {
            this.$('.modal-title').text(this.action.name);
            this.$('.page-appointment').text(this.action.appointment);
            this.$('#edit-save').text(this.action.buttonName);
        },
        render: function() {
            var $form = this.$('.modal-body form');
            $form.each(function() {
                $(this).triggerHandler('reset');
            });
            this.action.render();
            this.$('#modal-editing-body').scrollTop(0);
            this.$('.edit-shade').removeClass('loading');
        }

    });

    var actionCreate = {
        saveDone: function(resp, textStatus, jqXHR) {
            oms.users.url = oms.indexUrl + '/admin/index' + oms.fields.makeString();
            oms.users.fetch(oms.fetchOptions);
        },
        name: "Create New User",
        appointment: "This page is appointed for creating new user for particular role",
        buttonName: 'Create',
        render: function() {
            document.getElementById('User_username').value = '';
            document.getElementById('User_firstname').value = '';
            document.getElementById('User_lastname').value = '';
            document.getElementById('User_email').value = '';
            document.getElementById('User_password').value='';
            document.getElementById('User_confirmPassword').value='';
            userEditWindow.$('#User_region option').prop('selected',false);
            userEditWindow.$('#User_region option[value="north"]').prop('selected','true');
            userEditWindow.$('input[name="User[role]"]').prop('checked',false);
            userEditWindow.$('input[name="User[role]"]')
                .filter('[value="customer"]')
                .prop('checked','true');
        },
        refresh: function() {
            userEditWindow.render();
        }
    };

    var actionDuplicate = {
        saveDone: function(resp, textStatus, jqXHR) {
            oms.users.url = oms.indexUrl + '/admin/index' + oms.fields.makeString();
            oms.users.fetch(oms.fetchOptions);
        },
        name: 'Duplicate User',
        appointment: "This page is appointed for duplicating user for particular role",
        buttonName: 'Duplicate',
        render: function() {
            var attributes = userEditWindow.model.attributes;

            document.getElementById('User_username').value = '';
            document.getElementById('User_firstname').value = attributes.firstname;
            document.getElementById('User_lastname').value = attributes.lastname;
            document.getElementById('User_email').value = attributes.email;
            document.getElementById('User_password').value='';
            document.getElementById('User_confirmPassword').value='';
            userEditWindow.$('#User_region option').prop('selected',false);
            userEditWindow.$('#User_region option[value="' + attributes.region + '"]')
                .prop('selected','true');
            userEditWindow.$('input[name="User[role]"]').prop('checked',false);
            userEditWindow.$('input[name="User[role]"]').filter('[value="' + attributes.role + '"]')
                .prop('checked','true');
        },
        refresh: function() {
            userEditWindow.model.fetchUser({silent:false});
        }
    };

    var actionEdit = {
        saveDone: function(resp, textStatus, jqXHR) {
            userEditWindow.model.set($.parseJSON(resp));
            userEditWindow.model.row.render();
            $(oms.gridId).removeClass('grid-view-loading');

        },
        name: 'Edit User',
        appointment: "This page is appointed for editing user for particular role",
        buttonName: 'Update',
        render: function() {
            var attributes = userEditWindow.model.attributes;

            document.getElementById('User_username').value = attributes.username;
            document.getElementById('User_firstname').value = attributes.firstname;
            document.getElementById('User_lastname').value = attributes.lastname;
            document.getElementById('User_email').value = attributes.email;
            document.getElementById('User_password').value='';
            document.getElementById('User_confirmPassword').value='';
            userEditWindow.$('#User_region').prop('selected',false);
            userEditWindow.$('#User_region option[value="' + attributes.region + '"]')
                .prop('selected','true');
            userEditWindow.$('#User_deleted option[selected]').prop('selected',false);
            userEditWindow.$('#User_deleted option[value=' + (attributes.deleted==1?'1':'0') + ']')
                .prop('selected','true');
            userEditWindow.$('input[name="User[role]"]').prop('checked',false);
            userEditWindow.$('input[name="User[role]"]')
                .filter('[value="' + attributes.role + '"]')
                .prop('checked','true');
        },
        refresh: function() {
            userEditWindow.model.fetchUser({silent:false});
        }
    };

    // pager view
    var Pager = Backbone.View.extend({
        el: $('ul.yiiPager'),

        model: oms.fields,

        render: function(){
            _.each(this.model.buttons,this.renderButton,this);
            this.$el.show();
        },

        renderButton: function(button,key,list) {
            this.$("."+button.cssClass).toggleClass('hidden',!button.enabled);
        },

        hide: function(){
            this.$el.hide();
        }
    });

    var pager = new Pager;

    // instantiate table
    var userTable = new UserTable;
    
    var userEditWindow = new UserEditWindow;

    var router = new (Backbone.Router.extend({
        initialize: function(options) {
            this.firstTime = true;
            this.route(/(.*)/, 'fetchTable');
        },
        setParams: function(pars) {
            pars = pars || '';
            var page = pars.match(/User_page\/(\d+)/)
                , sort = pars.match(/User_sort\/([^\/]+)/)
                , showDel = pars.match(/showDel\/(\d)/)
                , pageSize = pars.match(/pageSize\/(\d+)/)
                , filters = pars.match(/AdminSearchForm\[keyField\]\/(\d+)\/AdminSearchForm\[criteria\]\/(\d+)\/AdminSearchForm\[keyValue\]\/([^\/]+)/);

            oms.fields.page       = page && parseInt(page[1]) || 1;
            oms.fields.sort       = sort && sort[1] || '';
            oms.fields.showDel    = showDel && parseInt(showDel[1]) || 0;
            oms.fields.pageSize   = pageSize && parseInt(pageSize[1]) || 10;
            oms.fields.nextPageSize = oms.fields.pageSizes[oms.fields.pageSize];

            $('#search-form').trigger('reset',{noop: true});
            if ( filters ) {
                oms.fields.filterField = filters[1];
                oms.fields.filterCriteria = filters[2];
                oms.fields.filterValue = filters[3];
                $("#search-form #AdminSearchForm_keyField option[value=" + filters[1] + "]").prop("selected",true);
                $("#search-form #AdminSearchForm_criteria option[value=" + filters[2] + "]").prop("selected",true);
                $("#search-form #AdminSearchForm_keyValue").val(filters[3]).triggerHandler('keyup');
            } else {
                oms.fields.filterValue = '';
            }
        },

        fetchTable: function(pars) {
            if ( !this.firstTime || pars ) {
                this.setParams(pars);
                if ( !this.firstTime || window.location.hash ) {
                    oms.users.url = oms.indexUrl + '/admin/index' + oms.fields.makeString();
                    oms.users.fetch(oms.fetchOptions);
                }
            }
            this.firstTime = false;
        }

    }));
        
    Backbone.history.start({
        pushState: true,
        root: oms.historyRoot,
    });    
});