<?php
    /**
     * Apologizes to user with message.
     */
    function apologize($message)
    {
        render("alerta.php", ["message" => $message]);
    }
    
    /**
     * Logs out current user, if any.  Based on Example #1 at
     * http://us.php.net/manual/en/function.session-destroy.php.
     */
    function logout()
    {
        // unset any session variables
        $_SESSION = [];

        // expire cookie
        if (!empty($_COOKIE[session_name()]))
        {
            setcookie(session_name(), "", time() - 42000);
        }

        // destroy session
        session_destroy();
    }

    /**
     * Redirects user to location, which can be a URL or
     * a relative path on the local host.
     *
     * http://stackoverflow.com/a/25643550/5156190
     *
     * Because this function outputs an HTTP header, it
     * must be called before caller outputs any HTML.
     */
    function redirect($location)
    {
        if (headers_sent($file, $line))
        {
            trigger_error("HTTP headers already sent at {$file}:{$line}", E_USER_ERROR);
        }
        header("Location: {$location}");
        exit;
    }

    /**
     * Renders view, passing in values.
     */
    function render($view, $values = [], $modalForm = null)
    {
        // if view exists, render it
        if (file_exists("../views/{$view}"))
        {
            // extract variables into local scope
            extract($values);

            // render header and view
            require("../views/_header.php");
            require("../views/{$view}");

            // Check if uses modal window, if the file exists and render
            if (isset($modalForm))
            {
                if (file_exists("../views/{$modalForm}"))
                {
                    require("../views/_modal_header.php");
                    require("../views/{$modalForm}");
                    require("../views/_modal_footer.php");
                }
                else
                {
                    trigger_error("Invalid view: {$modalForm}", E_USER_ERROR);
                }
            }

            // Render page footer
            require("../views/_footer.php");

            // Exit function
            exit;
        }

        // else err
        else
        {
            trigger_error("Invalid view: {$view}", E_USER_ERROR);
        }
    }

    /*
     * Function to flat array
     */
    function array_flatten ($nonFlat) {
        $flat = array();
        foreach (new RecursiveIteratorIterator(
                new RecursiveArrayIterator($nonFlat)) as $k=>$v) {
            $flat[$k] = $v;
        }
        return $flat;
    }

    /*
     * Recursive function to navigate array and write to a CSV file
     */
    function createCsv($xml,$f)
    {
        foreach ($xml->children() as $item) 
        {
            $hasChild = (count($item->children()) > 0) ? true : false;

            if (!$hasChild)
            {
                $put_arr = array($item->getName(),$item); 
                fputcsv($f, $put_arr, ',', '"');
            }
            else
            {
                createCsv($item, $f);
            }
        }
    }
?>