<?php
/**
 * Created by PhpStorm.
 * User: sergiuabrudean
 * Date: 14.08.2018
 * Time: 13:20
 */

class AdminController
{
    private $pdo;

    /**
     * AdminController constructor.
     *
     * @param $pdo
     */
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * @param $filename
     *
     * @return array
     */
    private function readCSV(string $filename) : array
    {
        $content = [];
        if (($handle = fopen($filename, "r")) !== false) {
            while (($data = fgetcsv($handle, 1000, ",")) !== false) {
                $content[] = $data;
            }
            fclose($handle);
        }

        return $content;
    }

    public function run()
    {
        echo "Welcome!" . PHP_EOL;
        $isDone = false;
        while (!$isDone) {

            echo "Your options are: " . PHP_EOL;
            echo "1 - Upload Genres" . PHP_EOL;
            echo "2 - Upload Movies" . PHP_EOL;
            echo "3 - Upload Rooms" . PHP_EOL;
            echo "4 - Upload Showtime" . PHP_EOL;
            echo "If you input anything else than these commands the process will terminate" . PHP_EOL;

            $userChoice = readline();

            switch ($userChoice) {
                case 1:
                    try {
                        $uploader = new GenreUploader($this->readCSV('genres'), $this->pdo);
                        echo "Genres uploaded successfully" . PHP_EOL;
                    } catch (Exception $e) {
                        echo "Something went wrong when uploading genres!" . PHP_EOL;
                    }
                    break;
                case 2:
                    try {
                        $uploader = new MovieUploader($this->readCSV('movies'), $this->pdo);
                        echo "Movies uploaded successfully" . PHP_EOL;
                    } catch (Exception $e) {
                        echo "Something went wrong when uploading movies!" . PHP_EOL;
                    }
                    break;
                case 3:
                    try {
                        $uploader = new RoomUploader($this->readCSV('rooms'), $this->pdo);
                        echo "Rooms uploaded successfully" . PHP_EOL;
                    } catch (Exception $e) {
                        echo "Something went wrong when uploading rooms!" . PHP_EOL;
                    }
                    break;
                case 4:
                    try {

                        $uploader = new ShowtimeUploader($this->userInputShowtimes(), $this->pdo);
                        echo "Showtimes uploaded successfully" . PHP_EOL;
                    } catch (Exception $e) {
                        echo "Something went wrong when uploading showtimes!" . PHP_EOL;
                    }
                    break;

                default:
                    $isDone = true;
                    echo "Program will exit now! Have a nice day!";
            }
        }
    }

    /**
     * @return array of array
     */
    private function userInputShowtimes() : array
    {
        return [];
    }
}
