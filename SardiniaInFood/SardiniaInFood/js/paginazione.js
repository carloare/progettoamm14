$(document).ready(function(){


$('table.commentipaginati').each(function() {
    
    var paginacorrente = 0; //pagina corrente
    var righeperpagina = 3; //risultati per pagina
    var $table = $(this); //tabella
   
   
   $table.bind('repaginate', function() {
        $table.find('tr').hide().slice(paginacorrente * righeperpagina, (paginacorrente + 1) * righeperpagina).show();});
    
    
    
    
    
    
    $table.trigger('repaginate');
    
    var numerorighe = $table.find('tr').length;
    
    
    var numeropagine = Math.ceil(numerorighe / righeperpagina);
    
    
    var $pager = $('<div class="pager"></div>');
    
    
    for (var pagina = 0; pagina < numeropagine; pagina++) {
        $('<span class="pagina-number"></span>').text(pagina + 1).bind('click', {
            nuovapagina: pagina
        }, function(event) {
            paginacorrente = event.data['nuovapagina'];
            $table.trigger('repaginate');
            $(this).addClass('active').siblings().removeClass('active');
        }).appendTo($pager).addClass('clickable');
    }
    
    
    $pager.insertBefore($table).find('span.pagina-number:first').addClass('active');
});


});
