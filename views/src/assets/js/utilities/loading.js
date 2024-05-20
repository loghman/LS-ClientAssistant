export const startLoading=(element,className="spinner-left")=>{
    element.classList.add(className)
}
export const endLoading=(element,className="spinner-left")=>{
    element.classList.remove(className)
}