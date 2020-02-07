<?php
require 'pdfcrowd.php';
include 'createTicket.php';

$location = "karte/";

if (
  isset($_GET["predstava"]) and !empty($_GET["predstava"]) and isset($_GET["datum"]) and !empty($_GET["datum"]) and
  isset($_GET["sala"]) and !empty($_GET["sala"]) and isset($_GET["sediste"]) and !empty($_GET["sediste"])
) {

  create($_GET["predstava"], $_GET["datum"], $_GET["sediste"], $_GET["sala"]);
  try {
    $datum = $string = str_replace(' ', '', $_GET["datum"]);
    $predstava = $string = str_replace(' ', '', $_GET["predstava"]);
    $sediste = $_GET["sediste"];
    // create the API client instance
    $client = new \Pdfcrowd\HtmlToPdfClient("dzeca", "4dfe67be083164e262f2cbf70a100c84");

    // create output file for conversion result
    $output_file = fopen($location."ticket.$datum$sediste.pdf", "wb");

    // check for a file creation error
    if (!$output_file)
      throw new \Exception(error_get_last()['message']);

    // run the conversion and store the result into the "pdf" variable
    $pdf = $client->convertFile("ticket.html");

    // write the "pdf" variable into the output file
    $written = fwrite($output_file, $pdf);

    // check for a file write error
    if ($written === false)
      throw new \Exception(error_get_last()['message']);

    // close the output file
    fclose($output_file);

    // header("Content-Type: application/pdf");
    // header("Cache-Control: max-age=0");
    // header("Accept-Ranges: none");
    // header("Content-Disposition: attachment; filename=\"ticket'.$datum.$sediste.'.pdf\"");

    // send the generated PDF 
    echo $location."ticket.$datum$sediste.pdf";
  } catch (\Pdfcrowd\Error $why) {
    // report the error
    error_log("Pdfcrowd Error: {$why}\n");

    // rethrow or handle the exception
    throw $why;
  }
}
