<?php
    class GC
    {
        /**
         * Library's configuration.
         */
        private static $config;
        
        /**
         * Initializes library with JSON file at $path.
         */
        public static function init($path)
        {
            // ensure library is not already initialized
            if (isset(self::$config))
            {
                trigger_error("GC Library is already initialized", E_USER_ERROR);
            }

            // ensure configuration file exists
            if (!is_file($path))
            {
                trigger_error("Could not find {$path}", E_USER_ERROR);
            }

            // read contents of configuration file
            $contents = file_get_contents($path);
            if ($contents === false)
            {
                trigger_error("Could not read {$path}", E_USER_ERROR);
            }

            // decode contents of configuration file
            $config = json_decode($contents, true);
            if (is_null($config))
            {
                trigger_error("Could not decode {$path}", E_USER_ERROR);
            }

            // store configuration
            self::$config = $config;
        }

        /**
         * Executes SQL statement, possibly with parameters, returning
         * an array of all rows in result set or false on (non-fatal) error.
         * Adapted from CS50 Library by Professor David J. Malan
         */
        public static function query(/* $sql [, ... ] */)
        {
            // ensure library is initialized
            if (!isset(self::$config))
            {
                throw new Exception("GC Library is not initialized");
            }

            // ensure database is configured
            if (!isset(self::$config["database"]))
            {
                throw new Exception("Missing value for database");
            }
            foreach (["host", "name", "password", "username", "charset"] as $key)
            {
                if (!isset(self::$config["database"][$key]))
                {
                    throw new Exception("Missing value for database.{$key}");
                }
            }

            // SQL statement
            $sql = func_get_arg(0);

            // parameters, if any
            $parameters = array_slice(func_get_args(), 1);

            // try to connect to database
            static $handle;
            if (!isset($handle))
            {
                // connect to database
                $handle = new PDO(
                    "mysql:dbname=" . self::$config["database"]["name"] . ";host=" . self::$config["database"]["host"] . ";charset=" . self::$config["database"]["charset"],
                    self::$config["database"]["username"],
                    self::$config["database"]["password"]
                );
            }
            // ensure number of placeholders matches number of values
            // http://stackoverflow.com/a/22273749
            // https://eval.in/116177
            $pattern = "/(?:'[^'\\\\]*(?:(?:\\\\.|'')[^'\\\\]*)*'| \"[^\"\\\\]*(?:(?:\\\\.|\"\")[^\"\\\\]*)*\"| `[^`\\\\]*(?:(?:\\\\.|``)[^`\\\\]*)*`)(*SKIP)(*F)| \?/x";
            preg_match_all($pattern, $sql, $matches);
            if (count($matches[0]) < count($parameters))
            {
                throw new Exception("Too few placeholders in query");
            }
            else if (count($matches[0]) > count($parameters))
            {
                throw new Exception("Too many placeholders in query");
            }

            // replace placeholders with quoted, escaped strings
            $patterns = [];
            $replacements = [];
            for ($i = 0, $n = count($parameters); $i < $n; $i++)
            {
                array_push($patterns, $pattern);
                array_push($replacements, preg_quote($handle->quote($parameters[$i])));
            }
            $query = preg_replace($patterns, $replacements, $sql, 1);

            // execute query
            $statement = $handle->query($query);
            if ($statement === false)
            {
                throw new Exception($handle->errorInfo()[2]);
            }
   
            // if query was SELECT
            // http://stackoverflow.com/a/19794473/5156190
            if ($statement->columnCount() > 0)
            {
                // return result set's rows
                return $statement->fetchAll(PDO::FETCH_ASSOC);
            }

            // if query was DELETE, INSERT, or UPDATE
            else
            {
                // return number of rows affected
                return $statement->rowCount();
            }
        }

        public static function getError($code, $message = '', $trace = '')
        {
            return array('code' => $code, 'message' => $message, 'trace' => $trace);
        }
    }
?>