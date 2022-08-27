export function getLocale()
{
    let currentUrl = window.location.href;
    let url = currentUrl.split("/");

    return url[3];
}

export function formatUrl(url)
{
    let locale = getLocale();
    return  url.replace("LOCALE", locale);
}
