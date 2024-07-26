
export function deleteTokenCookies() {
    // Get all cookies
    var cookies = document.cookie.split(";");
    for (var i = 0; i < cookies.length; i++) {
        var cookie = cookies[i].trim();
        var eqPos = cookie.indexOf("=");
        var name = eqPos > -1 ? cookie.substr(0, eqPos) : cookie;

        if (name === "token") {
            // Delete the cookie from current domain
            document.cookie = name + "=;expires=Thu, 01 Jan 1970 00:00:00 GMT;path=/";

            // Delete the cookie from all subdomains
            var domainParts = window.location.hostname.split(".");
            while (domainParts.length > 0) {
                var domain = domainParts.join(".");
                document.cookie = name + "=;expires=Thu, 01 Jan 1970 00:00:00 GMT;path=/;domain=." + domain;
                document.cookie = name + "=;expires=Thu, 01 Jan 1970 00:00:00 GMT;path=/;domain=" + domain; // Without leading dot
                domainParts.shift();
            }
        }
    }
}
