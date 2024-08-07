export const startLoading=(element,className="spinner-left")=>{
    jQuery(element).addClass(className)
}
export const endLoading=(element,className="spinner-left")=>{
    jQuery(element).removeClass(className)
}
