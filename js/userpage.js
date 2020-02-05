$('.btnReserve').click(function () {
    const $btn = $(this);
    const id = $btn.val();

    request = $.ajax({
        url: 'http://localhost/domaci3/predstave/'+id+'.json',
        type: 'get',
        dataType: 'json'
    });

    request.done(function (response, textStatus, jqXHR) {
        var predstava = response[0];
        $('#filmIzmeni').val(predstava.naziv);
        console.log(predstava.naziv);

        $('#zanrIzmeni').val(predstava.zanr.trim());
        console.log(predstava.zanr.trim());
        $('#trajanjeIzmeni').val(predstava.trajanje.trim());
        console.log(predstava.trajanje.trim());
        $('#utisakIzmeni').val(predstava.opis.trim());
        console.log(predstava.opis.trim());
        $('#izmeniForm input[name=id]').val(id);
      
        console.log("Podaci iz get by id "+response);
    });

    request.fail(function (jqXHR, textStatus, errorThrown) {
        console.error('Pojavila se sledeća greška: ' + textStatus, errorThrown);
    });

    $('#reservation').modal('toggle');
    return false;
});
