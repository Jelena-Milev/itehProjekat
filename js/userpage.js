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
      console.log("promenjen datum "+$('#datumiIzvodjenja').val())
      ucitajSedista();
    });
  });

function ucitajSedista(){
   // console.log("ucitaj sedista dat: "+$('#datumiIzvodjenja').val())
    //console.log("ucitaj sedista id: "+$('#btnRezervisi').val())
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
        console.log(predstava.naziv);

        $('#trajanjeIzmeni').val(predstava.trajanje.trim());
        console.log(predstava.trajanje.trim());
        //ovde sacuvam id predstave
        $('#btnRezervisi').val(id);
      
        console.log("Podaci iz get by id "+response);
    });

    request.fail(function (jqXHR, textStatus, errorThrown) {
        console.error('Pojavila se sledeća greška: ' + textStatus, errorThrown);
    });
}
$('#btnRezervisi').submit(function(){
    

});