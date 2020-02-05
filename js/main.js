$('#btn').click(function () {
    $('#pregled').toggle();
});

$('#btn-obrisi').click(function () {
    const checked = $('input[name=checked-film]:checked');
    request = $.ajax({
        url: 'handler/delete.php',
        type: 'post',
        data: {'id': checked.val()}
    });

    request.done(function (response, textStatus, jqXHR) {
        if (response === 'Success') {
            checked.closest('tr').remove();
            alert('Film je obrisan');
            console.log('Obrisan');
        }
        else {
            console.log('Film nije obrisan');
            alert('Film nije obrisan');
        }
        console.log(response);
    });

    request.fail(function (jqXHR, textStatus, errorThrown) {
        console.error('Pojavila se sledeća greška: ' + textStatus, errorThrown);
    });

    
});

$('#btnDodaj').submit(function () {
    $('#myModal').modal('toggle');
    return false;
});

$('#btnIzmeni').submit(function () {
    $('#myModal').modal('toggle');
    return false;
});

$('#dodajForm').submit(function () {
    event.preventDefault();
    console.log("Ovde");
    const $form = $(this);

    var array = jQuery($form).serializeArray();
    var json = {};
    
    jQuery.each(array, function() {
        json[this.name] = this.value || '';
    });
    console.log(json);

    const $inputs = $form.find('input, select, button, textarea');
    // console.log($inputs);
    // const serializedData = $form.serialize();
    // console.log(serializedData);
    $inputs.prop('disabled', true);

    request = $.ajax({
        url: 'http://localhost/domaci3/predstave',
        type: 'post',
        data: JSON.stringify(json)
    });

    request.done(function (response, textStatus, jqXHR) {
        console.log("Response: "+response);
        console.log("poruka: "+response.poruka);
        if (response.poruka === 'Predstava je uspešno ubačena') {
            console.log('Predstava je dodata');
            console.log('EVO');
            location.reload(true);
        }
        else console.log('Predstava nije dodata ' + odgovor.poruka);
        console.log(response);
    });

    request.fail(function (jqXHR, textStatus, errorThrown) {
        console.error('Pojavila se sledeća greška: ' + textStatus, errorThrown);
    });
    
});

$('#btn-izmeni').click(function () {
    const checked = $('input[name=checked-film]:checked');

    request = $.ajax({
        url: 'handler/get.php',
        type: 'post',
        data: {'id': checked.val()},
        dataType: 'json'
    });

    request.done(function (response, textStatus, jqXHR) {
        
        console.log('Popunjena forma');
        $('#filmIzmeni').val(response[0]['naziv']);
        console.log(response[0]['naziv']);

        $('#zanrIzmeni').val(response[0]['zanr'].trim());
        console.log(response[0]['zanr'].trim());
        $('#trajanjeIzmeni').val(response[0]['trajanje'].trim());
        console.log(response[0]['trajanje'].trim());
        $('#utisakIzmeni').val(response[0]['opis'].trim());
        console.log(response[0]['opis'].trim());
        $('#id').val(checked.val());
      
        console.log(response);
    });

    request.fail(function (jqXHR, textStatus, errorThrown) {
        console.error('Pojavila se sledeća greška: ' + textStatus, errorThrown);
    });


});

$('#izmeniForm').submit(function () {
    event.preventDefault();
    console.log("Izmene");
    const $form = $(this);
    const $inputs = $form.find('input, select, button, textarea');
    const serializedData = $form.serialize();
    console.log(serializedData);
    $inputs.prop('disabled', true);

    request = $.ajax({
        url: 'handler/update.php',
        type: 'post',
        data: serializedData
    });

    request.done(function (response, textStatus, jqXHR) {


        if (response === 'Success') {
            console.log('Film je izmenjen');
            location.reload(true);
            
        }
        else console.log('Film nije izmenjen ' + response);
        console.log(response);
    });

    request.fail(function (jqXHR, textStatus, errorThrown) {
        console.error('Pojavila se sledeća greška: ' + textStatus, errorThrown);
    });


    
});



$('#btn-pretraga').click(function () {

    var prikaz = document.querySelector('#myInput');
    console.log(prikaz);
    var style = window.getComputedStyle(prikaz);
    console.log(style);
    if (!(style.display === 'inline-block') || ($('#myInput').css("visibility") ==  "hidden")) {
        console.log('block');
        $('#myInput').show();
        document.querySelector("#myInput").style.visibility = "";
    } else {
       document.querySelector("#myInput").style.visibility = "hidden";
    }
});

