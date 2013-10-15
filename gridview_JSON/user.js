$(function(){

    Backbone.emulateHTTP = Backbone.emulateJSON = true;

    // global object with general properties
    oms = {
        gridId: 'oms-grid-view0',
        pageVar: 'User_page',
        sortVar: 'User_sort',
        showDeletedVar: 'showDel',
        sortSelector: '.sort-link',
        fetchOptions: {
            reset: true,
            error: function(collection, response, options) {
                if ( response.status == 403 ) {
                    window.location.href = "";
                } else {
                    alert("Error: " + response.status + " " + response.responseText);
                    $('#'+oms.gridId).removeClass('grid-view-loading');
                }
            }
        }
    };

    // models

    // model representing all nonstatic data on the page, except row
    oms.fields = new (Backbone.Model.extend({
        nextPageSize: 25,
        pageSizes: {25: 10, 10: 25},
        attributeLabels: {
            'User Name': 'username',
            'First Name': 'firstname',
            'Last Name': 'lastname',
            'Role': 'role',
            'Email': 'email',
            'Region': 'region'
        },
        defaults: {
            userCount:    0,
            showDeleted: 0,
            currentPage:  1,
            totalPages:    1,
            buttons: {
                First:    {
                    enabled:false,
                    cssClass:'first',
                    url: '',
                    getPageNumber: function() {
                        return 1;
                    }
                },
                Backward: {
                    enabled:false,
                    cssClass:'backward',
                    url: '',
                    getPageNumber: function() {
                        return oms.fields.get("currentPage")-1;
                    }
                },
                Forward:  {
                    enabled:false,
                    cssClass:'forward',
                    url: '',
                    getPageNumber: function() {
                        return oms.fields.get("currentPage")+1;
                    }
                },
                Last:     {
                    enabled:false,
                    cssClass:'last',
                    url: '',
                    getPageNumber: function() {
                        return oms.fields.get("totalPages");
                    }
                }
            }
        },
        setButtons: function() {
            // calculating total pages (userCount is set after reseting collection)
            var newTotalPages = Math.ceil(this.get("userCount")/this.pageSizes[this.nextPageSize]);
            newTotalPages = newTotalPages || 1;
            // setting current page (because of changed page size current page may become more than max page)
            this.set({
                "totalPages": newTotalPages,
                "currentPage": this.get("currentPage")>newTotalPages ? newTotalPages : this.get("currentPage")
            });
            // updating state of buttons with respect to new current and total pages
            this.get("buttons").First.enabled = this.get("buttons").Backward.enabled
                = (this.get("currentPage") > 1);
    
            this.get("buttons").Last.enabled = this.get("buttons").Forward.enabled 
                = (this.get("currentPage") < this.get("totalPages"));
        }
    }));

    // model representing a row
    var User = Backbone.Model.extend({
        url: 'index.php?r=admin/user',

        fetchUser: function() {
            var that = this;
            this.url = 'index.php?r=admin/user&id=' + this.get("id");
            this.fetch({         
                success: function() {
                    that.trigger('user:fetched');
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
                $('#'+oms.gridId).removeClass('grid-view-loading');
            });            
        }

    });

    // collection of rows
    var Users = Backbone.Collection.extend({

        model: User,

        initialize: function() { 
            this.url = window.location.href.split('?',1)[0]
                + '?r=admin/index&ajax=' + oms.gridId;
            this.on('request',function(model, xhr, options) {
                $('#'+oms.gridId).addClass('grid-view-loading');
            });
            this.on('reset',function() {
                oms.fields.set({
                    userCount: this.models[this.models.length-1].get("userCount")
                });
    
                this.length = --(this.models.length);

                userTable.addAll();
                $('#'+oms.gridId).removeClass('grid-view-loading');
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
            row.active = row.active?true:false;
            this.$el.html(this.template(row)); 

            if ( this.id%2 ) {
                this.$el.toggleClass('even',true);
            } else {
                this.$el.toggleClass('odd',true);
            }

            this.$el
                .toggleClass('user-deleted',(row.deleted==1))
                .toggleClass('user-active', row.active);

            this.$el.find('a[title="remove"]').on(
                'click',
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
            var showDeleted = oms.fields.get("showDeleted"),
                showDeletedParam,
                pageNumberParam = oms.pageVar + "=" + oms.fields.get("currentPage");
            showDeleted = showDeleted==1 ? 0 : 1;
            oms.fields.set({
                showDeleted: showDeleted
            });
            showDeletedParam = oms.showDeletedVar + "=" + showDeleted;
            oms.users.url = $.param.querystring(oms.users.url, showDeletedParam + "&" + pageNumberParam);
            oms.users.fetch(oms.fetchOptions);
            return false;
        },

        searchFormSubmit: function(event) {
            if ( $("input#AdminSearchForm_keyValue",this).val() ) {
                var data = $(this).serialize();
                data += '&' + oms.pageVar + '=1';
                oms.fields.set({
                    currentPage: 1
                });
                oms.users.url = $.param.querystring(oms.users.url,data);
                oms.users.fetch(oms.fetchOptions);
            }
            return false;
        },

        searchFormReset: function(event) {
            var url = oms.users.url,
                params = $.deparam.querystring(url);

            document.getElementById('btn-search').disabled=true;

            delete params['AdminSearchForm'];
            params[oms.pageVar] = 1;
            oms.fields.set({
                currentPage: 1
            });

            url = (url.split('?',1))[0];
            oms.users.url = $.param.querystring(url,params);
            oms.users.fetch(oms.fetchOptions);                
        },

        pageSizeClick: function(event) {
            // changing page size may cause changing of current page number
            var pageNumberParam = oms.pageVar + "=" + oms.fields.get("currentPage"),
                pageSizeParam = "pageSize=" + oms.fields.nextPageSize;
            // request string to server
            oms.users.url = $.param.querystring(oms.users.url, pageNumberParam+"&"+pageSizeParam);
            // updating model
            oms.fields.nextPageSize = oms.fields.pageSizes[oms.fields.nextPageSize];
            
            oms.users.fetch(oms.fetchOptions);                
            return false;
        },

        pageButtonClick: function(event) {
            if ( !$(this).hasClass('hidden') ) {
                var currentPage 
                    = oms.fields.get("buttons")[$(this).text()].getPageNumber();
                oms.fields.set({
                    currentPage: currentPage
                });

                oms.users.url = $.param.querystring(
                    oms.users.url, oms.pageVar + "=" + currentPage);
                oms.users.fetch(oms.fetchOptions);
            }
            return false;
        },

        sortLinkClick: function(event){
            if ( event.ctrlKey ) {
                var pageNumberParam = oms.pageVar + "=" + oms.fields.get("currentPage"),
                    sortAdd = oms.fields.attributeLabels[$(this).text()],
                    sortNow = $.deparam.querystring(oms.users.url)[oms.sortVar];
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
                sortNow = oms.sortVar + '=' + sortNow;

                oms.users.url = $.param.querystring(oms.users.url, sortNow + "&" + pageNumberParam);
                this.href = oms.users.url;
                oms.users.fetch(oms.fetchOptions);
            }
            return false;
        },

        removeClick: function(){
            var url = this.href;
            $('#confirm-deleting .btn-primary').click(function() {
                oms.users.url = $.param.querystring(oms.users.url,url);
                oms.users.fetch(oms.fetchOptions);
            });
            $('#confirm-deleting').modal();
            return false;
        },

        editClick: function(event) {
            var url = this.href,
                model = oms.users.get(event.data.modelId),
                prevAction = userEditWindow.action;
            userEditWindow.url = url;
            userEditWindow.action = event.data.action;
            userEditWindow.model = model;
            model.row = event.data.row;
            userEditWindow.$('.edit-shade').addClass('loading');
            userEditWindow.modalShow();
            if ( prevAction == userEditWindow.action ) {
                userEditWindow.listenTo(
                    userEditWindow.model,
                    'user:fetched',
                    userEditWindow.render
                );
            } else {
                userEditWindow.loadForm();
            }
            model.fetchUser();

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

        },

        render: function() {
            oms.fields.setButtons();            
            this.renderTotal();
            this.renderHeader();
            this.renderFooter();
            $("#page-size").text("show "+oms.fields.nextPageSize+" items");
        },

        renderHeader: function() {
            var params = $.deparam.querystring(oms.users.url);
            if ( params[oms.sortVar] ) {
                var sortAttr = params[oms.sortVar].split('-');
                $('#' + oms.gridId + ' th a').each(function(index) {
                    var $this = $(this),
                        attr = oms.fields.attributeLabels[$this.text()];
                                   
                    if (0 <= sortAttr.indexOf(attr) ) {
                        $this.removeClass('desc');
                        $this.addClass('asc');
                    } else if (0 <= sortAttr.indexOf(attr+'.desc') ) {
                        $this.removeClass('asc');
                        $this.addClass('desc');                    
                    } else {
                        $this.removeClass('asc');
                        $this.removeClass('desc');                    
                    }
                });
            } else {
                this.$('th a').removeClass('asc');
                this.$('th a').removeClass('desc');                    
            }
        },

        renderTotal: function() {
            $("#search-result-count").text(oms.fields.get("userCount"));
        },
        renderFooter: function() {
            if ( oms.users.length > 0 ) {
                $(".summary").text("page #"+oms.fields.get("currentPage")
                        +" of "+oms.fields.get("totalPages")).show();
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
                    $('#'+oms.gridId).addClass('grid-view-loading');
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
        
                    $('#cofirm-edit-cancel').on('shown',function(){
                        $('.modal-backdrop:last').insertBefore('#cofirm-edit-cancel');
                    });
                    $('#cofirm-edit-cancel').on('hidden',function(){
                        $('.modal-backdrop').remove();
                    });

                    that.renderBrace();
                    
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
            $modalWindow.on('hidden',function(){
                $modalWindow.find('#modal-editing-body').scrollTop(0);
                that.stopListening();
                $('.modal-backdrop').remove();
            });
            $modalWindow.on('shown',function(){
                $modalWindow.find('#modal-editing-body').scrollTop(0);
            });

            $('#cofirm-edit-cancel').on('shown',function(){
                $('.modal-backdrop:last').insertBefore('#cofirm-edit-cancel');
            });
            $('#cofirm-edit-cancel').on('hidden',function(){
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
            userEditWindow.model.fetchUser();
        }
    };

    var actionEdit = {
        saveDone: function(resp, textStatus, jqXHR) {
            userEditWindow.model.set($.parseJSON(resp));
            userEditWindow.model.row.render();
            $('#'+oms.gridId).removeClass('grid-view-loading');

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
            userEditWindow.model.fetchUser();
        }
    };

    // pager view
    var Pager = Backbone.View.extend({
        el: $('ul.yiiPager'),

        model: oms.fields,

        render: function(){
            _.each(this.model.get("buttons"),this.renderButton,this);
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

    // instanciate table
    var userTable = new UserTable;
    
    var userEditWindow = new UserEditWindow;    
});