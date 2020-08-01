var per_page = 5;
var last_page = 1;

$(document).ready(function(e){
    var ancestor = document.getElementById('contenedor');
    if (ancestor != null) {
        var items = ancestor.getElementsByClassName('it');
        set_disabled(items.length);
        document.getElementById(''+last_page+'').classList.add("active");
    }
    
});

$(document).on('click', '.pasar', function(e){
    e.preventDefault();
    document.getElementById(''+last_page+'').classList.remove("active");
    // var ancestor = document.getElementById('contenedor');
    var items = document.getElementsByClassName('it');
    add_hidden((last_page - 1)*per_page, items);
    check_entry($(this).attr('id'));
    remove_hidden((last_page - 1)*per_page, items);
    set_disabled(items.length);
    active = document.getElementById(''+last_page+'');
    document.getElementById(''+last_page+'').classList.add("active");
});

function add_hidden(inicio,list){
    limit = (inicio+per_page < list.length) ?inicio+per_page: list.length;
    for (i = inicio; i < limit; i++) {
        list[i].setAttribute('hidden', '');
    }
}

function remove_hidden(inicio,list){
    limit = (inicio+per_page < list.length) ?inicio+per_page: list.length;
    for (i = inicio; i < limit; i++) {
        list[i].removeAttribute('hidden');
    }
}

function check_entry(entry) {
    if (entry == 'p') {
        last_page -= 1;
    } else if (entry == 'n') {
        last_page += 1;
    } else{
        last_page = Number(entry);
    }
}

function set_disabled(m) {

    if (last_page - 1 > 0 && last_page + 1 <= Math.round(m/per_page)) {
        document.getElementById('p').classList.remove("disabled");
        document.getElementById('n').classList.remove("disabled");
    } else if (last_page == 1 && Math.round(m/per_page) > 1) {
        document.getElementById('p').classList.add("disabled");
        document.getElementById('n').classList.remove("disabled");
    } else if (last_page == Math.round(m/per_page) && Math.round(m/per_page) > 1) {
        document.getElementById('p').classList.remove("disabled");
        document.getElementById('n').classList.add("disabled");
    }

}

// ADD FAVORITO //

$(document).on('click', '.b_whished', function(e){
    e.preventDefault();
    console.log('add to wished');
});

$(function () {
    $('[data-toggle="popover"]').popover({
        trigger: "hover"
    })
})