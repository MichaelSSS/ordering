$(function(){

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
                    alert("Error: " + response.status + "\n" + response.responseText);
                    $('#'+oms.gridId).removeClass('grid-view-loading');
                }
            }
        },
    };
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

    var User = Backbone.Model;

    var Users = Backbone.Collection.extend({

        model: User,

        initialize: function() { 
            this.on('request',function() {
                $('#'+oms.gridId).addClass('grid-view-loading');
            });
            this.on('reset',function() {
                oms.fields.set({
                    userCount: this.models[this.models.length-1].get("userCount")
                });
    
                this.models.length--;

                userTable.addAll();
                $('#'+oms.gridId).removeClass('grid-view-loading');
            });
        },

        url: 'index.php?r=admin/index&ajax='+oms.gridId+'&'+oms.sortVar+'=username'
    });

    oms.users = new Users;

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
            if ( row.deleted==1 ) {
                this.$el.addClass('user-deleted');
            } else if ( row.active ) {
                this.$el.addClass('user-active');
            }

            this.$el.find('a[title="remove"]').on('click',function(){
                var url = this.href;
                $('#confirm-deleting .btn-primary').click(function() {
                    oms.users.url = $.param.querystring(oms.users.url,url);
                    oms.users.fetch(oms.fetchOptions);
                });
                $('#confirm-deleting').modal();
                return false;
            });

            return this;

        }
    });

    var UserTable = Backbone.View.extend({
        
        el: $("#table-user"),

        initialize: function() { 

            $('#toggle-deleted').on('click', function() {
                var showDeleted = oms.fields.get("showDeleted");
                showDeleted = showDeleted==1 ? 0 : 1
                oms.fields.set({
                    showDeleted: showDeleted
                });
                oms.users.url = $.param.querystring(oms.users.url, oms.showDeletedVar + "=" + showDeleted);
                oms.users.fetch(oms.fetchOptions);
                return false;
            });

            $('#search-form').on('submit', function(event) {
                if ( $("input#AdminSearchForm_keyValue",this).val() ) {
                    var data = $(this).serialize();
                    data += '&' + oms.pageVar + '=1';                
                    oms.users.url = $.param.querystring(oms.users.url,data);
                    oms.users.fetch(oms.fetchOptions);
                }
                return false;
            });
            $('#search-form').on('reset', function(event) {
                var url = oms.users.url,
                    params = $.deparam.querystring(url);

                document.getElementById('btn-search').disabled=true;

                delete params['AdminSearchForm'];
                url = (url.split('?',1))[0];
                oms.users.url = $.param.querystring(url,params);
                oms.users.fetch(oms.fetchOptions);                
            });

            $("#page-size").on('click',function(event) {
                var pageNumberParam = oms.pageVar + "=" + oms.fields.get("currentPage"),
                    pageSizeParam = "pageSize=" + oms.fields.nextPageSize;
                // request string to server
                oms.users.url = $.param.querystring(oms.users.url, pageNumberParam+"&"+pageSizeParam);
                // updating model
                oms.fields.nextPageSize = oms.fields.pageSizes[oms.fields.nextPageSize];
                // setting requested page number as current (it may become more than max pages, but it will be corrected before rendering pager)
                /*oms.fields.set({
                    currentPage: $.deparam.querystring(oms.users.url)[oms.pageVar]
                });*/
                // updating anchor link, though it is not necessary, because it is not used in creating request url
                this.href = $.param.querystring(oms.users.url, "pageSize="+oms.fields.nextPageSize);
                
                oms.users.fetch(oms.fetchOptions);                
                return false;
            });

            $('ul.yiiPager li').on("click",function(event) {
                if ( !$(this).hasClass('hidden') ) {
                    var currentPage = oms.fields.get("buttons")[$(this).text()].getPageNumber();
                    oms.fields.set({
                        currentPage: currentPage
                    });
    
                    oms.users.url = $.param.querystring(oms.users.url, oms.pageVar + "=" + currentPage)
                    oms.users.fetch(oms.fetchOptions);
                }
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

            $('#' + oms.gridId + ' th:first a').addClass('asc');
            $(oms.sortSelector).on('click',function(event){
                if ( event.ctrlKey ) {
                    var sortAdd = oms.fields.attributeLabels[$(this).text()],
                        sortNow = $.deparam.querystring(oms.users.url)[oms.sortVar],
                        toggleClassDesc = false;                        
                    if ( sortNow ) {
                        // if we already sorted by some column
                        var sortAttr = sortNow.split('-');
                        var existingPos = sortAttr.indexOf(sortAdd);
                        if ( 0 <= existingPos ) {
                            // already sorted by given column asc
                            toggleClassDesc = true;
                            sortAdd += '.desc';
                            sortAttr.splice(existingPos,1);
                            sortAttr.unshift(sortAdd);
                            sortNow = sortAttr.join('-');
                        } else {
                            existingPos = sortAttr.indexOf(sortAdd+'.desc');
                            if ( 0 <= existingPos ) {
                                // already sorted desc
                                toggleClassDesc = true;
                                sortAttr.splice(existingPos,1);
                                sortAttr.unshift(sortAdd);
                                sortNow = sortAttr.join('-');
                            } else {
                                // have not sorted by a given column
                                sortNow = sortAdd + '-' + sortNow;
                            }
                        }    
                    } else {
                        //have not sort by either column
                        sortNow = sortAdd;
                    }
                    sortNow = oms.sortVar + '=' + sortNow;

                    oms.users.url = $.param.querystring(oms.users.url, sortNow);
                    this.href = oms.users.url;
                    oms.users.fetch(oms.fetchOptions);
/*                    $(this).toggleClass('asc');
                    if(toggleClassDesc) {
                        $(this).toggleClass('desc');
                    }
*/
                }
                return false;
            });

        },

        render: function() {
            pager.render();
            this.renderHeader();
            this.renderTotal();
            this.renderSummary();
            $("#page-size").text("show "+oms.fields.nextPageSize+" items");
            $('#toggle-deleted').text(oms.fields.get("showDeleted")==0 ? "show deleted" : "hide deleted");
        },

        renderHeader: function() {
            var sortAttr = $.deparam.querystring(oms.users.url)[oms.sortVar].split('-');
            $('#' + oms.gridId + ' th a').each(function(index){
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

        },

        renderTotal: function() {
            $("#search-result-count").text(oms.fields.get("userCount"));
        },
        renderSummary: function() {
            $(".summary").text("page #"+oms.fields.get("currentPage")+" of "+oms.fields.get("totalPages"));
        }, 
        addOne: function(useri, i) {
            var row = new UserRow({model: useri, id: i});
            this.$el.append(row.render().el);
        },
    
        addAll: function() {
            this.$("tr").filter(function(index){return index > 0}).remove();
            oms.users.each(this.addOne, this);
            this.render();
        }
    });

    var Pager = Backbone.View.extend({
        el: $('ul.yiiPager'),

        model: oms.fields,

        render: function(){
            this.model.setButtons();
            _.each(this.model.get("buttons"),this.renderButton,this);
        },

        renderButton: function(button,key,list) {
            this.$("."+button.cssClass).toggleClass('hidden',!button.enabled);
        }
    });

    var pager = new Pager;

    var userTable = new UserTable;
});