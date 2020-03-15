function logOut(){
    document.cookie = "loggedIn= ; expires = Thu, 01 Jan 1970 00:00:00 GMT";
    document.cookie = "PHPSESSID= ; expires = Thu, 01 Jan 1970 00:00:00 GMT";
    window.location.href = "./login";
}