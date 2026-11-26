<?php

enum LogLevel: string
{
    case DEBUG = "debug";
    case INFO = "info";
    case WARN = "warn";
    case ERROR = "error";
    case FATAL = "fatal";
}

class Logger
{
    private static string $logDirectory = ROOT . "logs/";

    /**
     * Enregistre un message dans un fichier de log selon le niveau de gravité indiqué.
     *
     * Crée automatiquement le répertoire de logs s'il n'existe pas, puis ajoute
     * une nouvelle entrée horodatée dans un fichier dédié au niveau de log.
     *
     * Le fichier est nommé selon le format :
     * kerdrink_YYYY-MM-DD_LEVEL.log
     *
     * @param LogLevel $level   Niveau de gravité du message.
     * @param string   $origin  Origine du message (classe, méthode ou composant).
     * @param string   $message Contenu du message à enregistrer.
     *
     * @return void
     */
    public static function log(LogLevel $level, string $origin, string $message): void
    {
        if (!is_dir(self::$logDirectory))
            mkdir(self::$logDirectory, 0750, true);

        $date = date("Y-m-d");
        $timestamp = date("Y-m-d H:i:s");
        $type = strtoupper($level->value);

        $file = self::$logDirectory . "kerdrink_" . $date . "_" . $type . ".log";
        $entry = "[$timestamp] [$type] | [$origin] : $message" . PHP_EOL;

        file_put_contents($file, $entry, FILE_APPEND | LOCK_EX);
    }
}
