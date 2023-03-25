<?php

namespace Ls\ClientAssistant\Utilities\Tools;

class Download
{
    public static function arrayToCsv($array, $filename = "export.csv", $delimiter = ",")
    {
        // open raw memory as file so no temp files needed, you might run out of memory though
        $f = fopen('php://memory', 'w');
        # this line is for utf8 support
        fprintf($f, chr(0xEF) . chr(0xBB) . chr(0xBF));
        // loop over the input array
        foreach ($array as $line) {
            // generate csv lines from the inner arrays
            fputcsv($f, $line, $delimiter);
        }
        // reset the file pointer to the start of the file
        fseek($f, 0);
        // tell the browser it's going to be a csv file
        header('Content-Type: text/csv');
        // tell the browser we want to save it instead of displaying it
        header('Content-Disposition: attachment; filename="' . $filename . '";');
        // make php send the generated csv lines to the browser
        fpassthru($f);
    }

}