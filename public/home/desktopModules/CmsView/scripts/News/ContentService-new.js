app.service("myService", function ($http) {
    'use strict';

    // get All category By Page
    this.getAllCategories = function (ParentId) {
        var response = $http({
            method: "get",
            url: baseUrl + "/newscategory/listall",
            params: {
                parentid: ParentId
            }
        });
        return response;
    }
    // get category By Id
    this.getCategoryById = function (Id) {
        var response = $http({
            method: "get",
            url: baseUrl + "/newscategory/getbyid",
            params: {
                Id: Id
            }
        });
        return response;
    }

    // get All Types
    //this.getAllTypes = function () {
    //    var response = $http({
    //        method: "get",
    //        url: baseUrl + "/type/list",
    //    });
    //    return response;
    //}
    // get All Levels
    //this.getAllLevels = function () {
    //    var response = $http({
    //        method: "get",
    //        url: baseUrl + "/level/list",
    //    });
    //    return response;
    //}

    this.getNewsBlockContents = function (PortalId, ModuleId, GetType, PageIndex, txtKeyword) {
        var response = $http({
            method: "get",
            url: baseUrl + "/NewsContent/listnew",
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            params: {
                PortalId: PortalId,
                ModuleId: ModuleId,
                GetType: GetType,
                PageIndex: PageIndex,
                txtKeyword: txtKeyword
            }
        });
        return response;
    }

    // get All News content By Page
    this.getNewsContents = function (PortalId, ModuleId, CategoryId, IsByCategoryId, PageIndex, PageSize, NumberMoreNews, txtKeyword) {
        var response = $http({
            method: "get",
            url: baseUrl + "/NewsContent/list",
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            params: {
                PortalId: PortalId,
                ModuleId: ModuleId,
                CategoryId: CategoryId,
                IsByCategoryId: IsByCategoryId,
                PageIndex: PageIndex,
                PageSize: PageSize,
                NumberMoreNews: NumberMoreNews,
                txtKeyword: txtKeyword
            }
        });
        return response;
    }

    // get Business By Id
    this.getItemById = function (Id) {
        var response = $http({
            method: "get",
            url: baseUrl + "/NewsContent/getbyid",
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            params: {
                id: Id
            }
        });
        return response;
    }

    // Like news
    this.Like = function (NewsItem) {
        var response = $http({
            method: "post",
            url: baseUrl + "/NewsContent/Like",
            data: JSON.stringify(NewsItem),
            dataType: "json"
        });
        return response;
    }

    // Vote news
    this.Vote = function (NewsItem) {
       
        var response = $http({
            method: "post",
            url: baseUrl + "/NewsContent/Vote",
            data: JSON.stringify(NewsItem),
            dataType: "json"
        });
        return response;
    }

    //Rate news
    this.Rate = function (NewsItem) {
        var response = $http({
            method: "post",
            url: baseUrl + "/news/Rate",
            data: JSON.stringify(NewsItem),
            dataType: "json"
        });
        return response;
    }
});