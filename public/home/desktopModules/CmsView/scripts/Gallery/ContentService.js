app.service("GalleryService", function ($http) {
    'use strict';

    ////Total category
    //this.TotalItems = function (PortalId, ParentId) {
    //    var response = $http({
    //        method: "get",
    //        url: baseUrl + "/GalleryCategory/totals",
    //        params: {
    //            PortalId: PortalId,
    //            ParentId: ParentId
    //        }
    //    });
    //    return response;
    //};
    // get All category By Page
    this.getAllCategories = function (portalId, moduleId, ParentId, PageIndex, PageSize) {
        var response = $http({
            method: "get",
            url: baseUrl + "/GalleryCategory/list",
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
    // get category By Id
    this.getCategoryById = function (Id) {
        var response = $http({
            method: "get",
            url: baseUrl + "/GalleryCategory/getbyid",
            params: {
                id: Id
            }
        });
        //console.log(response);
        return response;
    }

    // get All Types By Page
    this.getAllItems = function (PortalId, ModuleId, CategoryId, PageIndex, PageSize) {
        var response = $http({
            method: "get",
            url: baseUrl + "/Gallery/list",
            params: {
                portalid: PortalId,
                moduleid: ModuleId,
                categoryid: CategoryId,
                pageindex: PageIndex,
                pagesize: PageSize
            }
        });
        return response;
    }

    // get ANTD
    this.getANTD = function (PortalId, ModuleId, CategoryId, NumberOfNews, PageIndex, PageSize) {
        var response = $http({
            method: "get",
            url: baseUrl + "/Gallery/getantd",
            params: {
                portalid: PortalId,
                moduleid: ModuleId,
                categoryid: CategoryId,
                NumberOfNews: NumberOfNews,
                pageindex: PageIndex,
                pagesize: PageSize
            }
        });
        return response;
    }

    // get Event Image
    this.getHome = function (PortalId, ModuleId, CategoryId, NumberOfNews, PageIndex, PageSize) {
        var response = $http({
            method: "get",
            url: baseUrl + "/Gallery/gethome",
            params: {
                portalid: PortalId,
                moduleid: ModuleId,
                categoryid: CategoryId,
                NumberOfNews: NumberOfNews,
                pageindex: PageIndex,
                pagesize: PageSize
            }
        });
        return response;
    }

    // get Business By Id
    this.getItemById = function (Id) {
        var response = $http({
            method: "get",
            url: baseUrl + "/Gallery/getbyid",
            params: {
                id: JSON.stringify(Id)
            }
        });
        return response;
    }

    
});