app.service("CategoryService", function ($http) {
    'use strict';
    
    // get All category By Page
    this.getBySettings = function (PortalId, ModuleId) {
        var response = $http({
            method: "get",
            url: baseUrl + "/newscategory/listbysetting",
            params: {
                PortalId: PortalId,
                ModuleId: ModuleId
            }
        });
        return response;
    }
    // get All category By Page
    this.getSiteMaps = function (portalId, moduleId, ParentId, PageIndex, PageSize) {
        var response = $http({
            method: "get",
            url: baseUrl + "/newscategory/listsitemap",
            params: {
                portalId: portalId,
                moduleId: moduleId,
                parentid: ParentId,
                PageIndex: PageIndex,
                PageSize: PageSize
            }
        });
        return response;
    }

    // get category By Page and By ParentId
    this.getItemByPageAndParentId = function (PtId, MdId, ParentId, PageIndex, PageSize) {
        var response = $http({
            method: "get",
            url: baseUrl + "/newscategory/list",
            params: {
                portalId: PtId,
                moduleid: MdId,
                parentid: ParentId,
                pageindex: PageIndex,
                pagesize: PageSize
            }
        });
        return response;
    }

    // get category By Id
    this.getItem = function (Id) {
        var response = $http({
            method: "get",
            url: baseUrl + "/newscategory/getbyid",
            params: {
                id: JSON.stringify(Id)
            }
        });
        //console.log(response);
        return response;
    }

    // get Tabs
    this.getTabs = function () {
        var response = $http({
            method: "get",
            url: baseUrl + "/dnn/listtabs"
        });
        return response;
    }

});