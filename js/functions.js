function pagination(numPage, nbPages, typePagination){
    var pageNumberElement;
    var listPagination;
    var i;
    for (i = 1; i <=nbPages;i++){
        pageNumberElement = document.getElementById("pageNumber"+typePagination+i);
        pageNumberElement.classList.remove("pagination-items");
        pageNumberElement.classList.remove("pagination-items-selected");
    }
    for (i = 1; i <=nbPages;i++){
        listPagination = document.getElementById("listPagination"+typePagination+i);;
        pageNumberElement = document.getElementById("pageNumber"+typePagination+i);
        if(i == numPage){
            listPagination.classList.remove("pagination-hidden");
            listPagination.classList.add("pagination-visible");
            pageNumberElement.classList.add("pagination-items-selected")
        }else{
            pageNumberElement.classList.add("pagination-items");
            listPagination.classList.remove("pagination-visible");
            listPagination.classList.add("pagination-hidden");
        }
    }
}