<!DOCTYPE html>
<html lang="en-US">
    <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular-cookies.js"></script>
    <body>
        <style type="text/css">
            .bookmarkIcon{background-image: url(bookmark.png); background-repeat: no-repeat; background-position: top left; background-size: 15px 15px;}
        </style>
        <div ng-app="myCookieBasedBookmark" ng-controller="homeController">
            <table cellspacing="50" cellpadding="15" style="border:2px solid #E8E8E8;">
                <tr ng-repeat="item in [41, 42, 43, 45] track by $index">
                    <td class="ellipsis" ng-model="bookmarked" ng-class="{'bookmarkIcon':getBookmarkIcon(item)}">
                        <a ng-click="bookmarked=!bookmarked; toggleBookmark(item);" href="javascript:void(0);" title="{{(getBookmarkIcon(item))?'Remove bookmark':'Bookmark this area'}}">{{item}}</a></td>
                    <td>99</td>
                    <td>12</td>
                    <td>40</td>
                </tr>
            </table>
        </div>
        <script>
            var app = angular.module('myCookieBasedBookmark', ['ngCookies']);
            app.controller('homeController', ['$cookieStore', '$cookies', '$scope', function($cookieStore, $cookies, $scope) {
                $scope.bookmarked = false;
                $scope.bookmarks = $cookieStore.get('data_bookmark') ? $cookieStore.get('data_bookmark') : { items:[] };   
                console.log($scope.bookmarks);
                $scope.toggleBookmark = function(resortId) {                     
                    var data = $scope.bookmarks.items;
                    var found = false;
                    for(var key in data) {          
                        if(data[key].id===resortId) {
                            var index = Object.keys(data).indexOf(key);                   
                            $scope.bookmarks.items.splice(index, 1); found = true; break;        
                        }       
                    }
                    
                    if(!found){                    
                      $scope.bookmarks.items.push({ id:resortId });    
                    }
                    $cookieStore.put('data_bookmark',$scope.bookmarks);                    
                    var cookie = $cookieStore.get('data_bookmark');
                    console.log(cookie);
                };
  
                $scope.getBookmarkIcon = function(resortId) {
                    var found = false;
                    var dataList = $scope.bookmarks.items;         
                    dataList.filter(function(item) {         
                        if(item.id===resortId) {
                            found = true;          
                        }        
                    });
                    return found;
                };  
            }]);
        </script>
    </body>
</html> 
