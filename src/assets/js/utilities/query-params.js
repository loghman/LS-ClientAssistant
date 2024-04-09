export const setQueryParam = function (url, name, value) {
    let urlObject = new URL(url);

    if (value == '') {
        urlObject.searchParams.delete(name);
    }else {
        urlObject.searchParams.set(name, value);
    }

    return urlObject.href;
}
