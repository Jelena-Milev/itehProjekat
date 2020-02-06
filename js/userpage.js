$('.btnReserve').click(function () {
    const $btn = $(this);
    const id = $btn.val();

    ucitajPredstavu(id);

    ucitajDatumeIzvodjenja(id);

    $('#reservation').modal('toggle');
    return false;
});

$(document).ready(function() {
    $('#datumiIzvodjenja').change(function() {
      ucitajSedista();
    });
  });

function ucitajSedista(){
    if($('#datumiIzvodjenja').val() == 'testni'){
        console.log("testni izabran");
        $("#sediste").empty();
        return;
    }
    request = $.ajax({
        url: 'http://localhost/domaci3/predstave/'+ $('#btnRezervisi').val()+'/'+$('#datumiIzvodjenja').val()+'.json',
        type: 'get',
        dataType: 'json'
     });

     request.done(function (response, textStatus, jqXHR) {
        $("#sediste").empty();
        response.forEach(function(value, index){
            $('#sediste').append('<option value='+value.id+'>' + value.id + '</option>');
        });

     });

     request.fail(function (jqXHR, textStatus, errorThrown) {
        console.error('Pojavila se sledeća greška: ' + textStatus, errorThrown);
     });

}

function ucitajDatumeIzvodjenja(id){
    request = $.ajax({
        url: 'http://localhost/domaci3/izvodjenja/'+id+'.json',
        type: 'get',
        dataType: 'json'
    });

    request.done(function (response, textStatus, jqXHR) {
        $("#datumiIzvodjenja").empty();
        $('#datumiIzvodjenja').append('<option value="testni"> Izberite datum </option>');
        response.forEach(function(value, index){
            $('#datumiIzvodjenja').append('<option value='+value.datum+'>' + value.formDatum + '</option>');
        });

    });

    request.fail(function (jqXHR, textStatus, errorThrown) {
        console.error('Pojavila se sledeća greška: ' + textStatus, errorThrown);
    });

}

function ucitajPredstavu(id){
    request = $.ajax({
        url: 'http://localhost/domaci3/predstave/'+id+'.json',
        type: 'get',
        dataType: 'json'
    });

    request.done(function (response, textStatus, jqXHR) {
        var predstava = response[0];
        $('#filmIzmeni').val(predstava.naziv);

        $('#trajanjeIzmeni').val(predstava.trajanje.trim());
        //ovde sacuvam id predstave
        $('#btnRezervisi').val(id);      
    });

    request.fail(function (jqXHR, textStatus, errorThrown) {
        console.error('Pojavila se sledeća greška: ' + textStatus, errorThrown);
    });
}
$('#btnRezervisi').submit(function(){
    

});