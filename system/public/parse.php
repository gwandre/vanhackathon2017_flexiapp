<?php
    require(__DIR__ . "/../../includes/config.php");



    // if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        // else render form
        render("parse_form.php", ["title" => "Parse Files to CSV Format"]);
    }

    // else if user reached page via POST (as by submitting a form via POST)
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // Define file code to upload/download
        $fileCode = date('YmdHis');

        // Upload XML/JSON to parse
        $targetFileType = strtolower(pathinfo(basename($_FILES["fileToUpload"]["name"]), PATHINFO_EXTENSION));
        $targetFile = "../upload/uploaded_" . $fileCode . '.' . $targetFileType;
        $csvFile = "csv/" . $targetFileType . "tocsv_" . $fileCode . '.csv';

        if($targetFileType != "xml" && $targetFileType != "json")
        {
            apologize("Invalid file type: please select JSON or XML file to upload.");
        }
        else
        {
            if (!move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFile))
            {
                apologize("Sorry, the system failed to upload the file.");
            }
            else
            {
                // Try to parse files
                try
                {
                    // Open new CSV file to write
                    $fp = fopen($csvFile, 'w');

                    // Decode JSON file
                    if ($targetFileType == "json")
                    {
                        // Open uploaded file data and decode JSON
                        $data = file_get_contents(__DIR__ . "/" . $targetFile);
                        $jsonData = json_decode($data, true);

                        // Write data into CSV file
                        foreach ($jsonData['Applications'] as $line) {
                            fputcsv($fp, array_flatten($line));
                        }
                    }

                    // Decode XML File
                    else if ($targetFileType == "xml")
                    {
                        // Open uploaded file data and decode XML
                        $data = file_get_contents(__DIR__ . "/" . $targetFile);
                        $xml = simplexml_load_string(str_ireplace("soap:", "", $data));

                        // Decode XML Data to JSON
                        $jsonData = json_decode(json_encode($xml), true);

                        // Write data into CSV file
                        foreach ($jsonData as $line) {
                            fputcsv($fp, array_flatten($line));
                        }

                        // Write data into CSV file (Each Field one Line)
                        //createCsv($xml, $fp);
                    }

                    // Close the new CSV file
                    fclose($fp);
                }

                // Exception treatment
                catch (Exception $e)
                {
                    apologize($e->getMessage());
                }

                // render page with parse result
                render("parse_result.php", ["title" => "Parse Files Result", "csvFile" => $csvFile]);
            }
        }
    }
?>