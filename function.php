<?php
header("Content-Type:text/html; charset=UTF-8");

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

require 'assets/PHPMailer/src/Exception.php';
require 'assets/PHPMailer/src/PHPMailer.php';
require 'assets/PHPMailer/src/SMTP.php';
include "dbconnect.php";
//******************login function****************/
function login()
{
    global $connection;

    if (isset($_POST['submit'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $username = mysqli_real_escape_string($connection, $username);
        $password = mysqli_real_escape_string($connection, $password);

        //query to get users from user
        $query = "SELECT * FROM user WHERE username = '$username' AND password = '$password' AND level = 1";
        $result = mysqli_query($connection, $query);
        $count = mysqli_num_rows($result);
        if ($count < 1) {
            return header("Location: index.php?errorLogin");
        }

        while ($row = mysqli_fetch_array($result)) {
            if ($username == $row['username'] && $password == $row['password']) {
                $_SESSION['userId'] = $row['id'];
                $_SESSION['username'] = $row['username'];
                $_SESSION['name'] = $row['name'];
                $_SESSION['lastname'] = $row['lastname'];
                $_SESSION['level'] = $row['level'];
                return header("Location: creaConsulente.php");
            } else {
                return header("Location: index.php?errorLogin");
            }
        }
    }
}
//******************login function****************/

//******************logout function****************/
function logOut()
{
    if (isset($_POST['logout'])) {
        $_SESSION = array();
        session_destroy();
        return header("Location: index.php");
        exit();
    }
}
//******************logout function****************/

//******************crea user function****************/
function creaUser()
{
    global $connection;
    $submit = $_POST['submit'];

    $nome = $_POST['nome'];
    $nome = str_replace(array("'", "’"), array("\'", "\'"), $nome);

    $cognome = $_POST['cognome'];
    $cognome = str_replace(array("'", "’"), array("\'", "\'"), $cognome);

    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $level = 0;

    $citta = $_POST['citta'];
    $citta = str_replace(array("'", "’"), array("\'", "\'"), $citta);
    $provincia = $_POST['provincia'];
    $provincia = str_replace(array("'", "’"), array("\'", "\'"), $provincia);
    $regione = $_POST['regione'];
    $regione = str_replace(array("'", "’"), array("\'", "\'"), $regione);

    $citta_due = $_POST['citta_due'];
    $citta_due = str_replace(array("'", "’"), array("\'", "\'"), $citta_due);
    $provincia_due = $_POST['provincia_due'];
    $provincia_due = str_replace(array("'", "’"), array("\'", "\'"), $provincia_due);
    $regione_due = $_POST['regione_due'];
    $regione_due = str_replace(array("'", "’"), array("\'", "\'"), $regione_due);

    if (isset($submit)) {
        $queryCheck = "SELECT username FROM user WHERE username = '$username'";
        $resultCheck = mysqli_query($connection, $queryCheck);
        $countCheck = mysqli_num_rows($resultCheck);
        if ($countCheck > 0) {
            echo "<script type='text/javascript'>";
            echo "alert('Questo username è occupato!')";
            echo "</script>";
        } else {
            $query = "INSERT INTO user (username, password, name, lastname, email, phone, citta, provincia, regione, citta_due, provincia_due, regione_due, level) VALUES ('$username', '$password', '$nome', '$cognome', '$email', '$phone', '$citta', '$provincia', '$regione', '$citta_due', '$provincia_due', '$regione_due', '$level')";
            $result = mysqli_query($connection, $query);
            $lastId = mysqli_insert_id($connection);

            /************************* upload ID photo script **************************/
            if ($_FILES['file']['name'] != "") {
                $query_username = "SELECT id, username FROM user WHERE id = '$lastId'";
                $result_username = mysqli_query($connection, $query_username);
                $row_username = mysqli_fetch_assoc($result_username);
                $user_username = $row_username['username'];
                $user_userid = $row_username['id'];

                $name = $_FILES['file']['name'];
                $target_dir = "profilePhoto/";
                $target_file = $target_dir . basename($_FILES["file"]["name"]);

                // Select file type
                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

                // Valid file extensions
                $extensions_arr = array("jpg", "jpeg", "png");

                // Check extension
                if (in_array($imageFileType, $extensions_arr)) {

                    $newName = $user_username . '.' . $imageFileType;

                    // Insert record
                    $query = "insert into fotoProfile (foto_nome,user_id) values ('" . $newName . "','" . $user_userid . "')";

                    mysqli_query($connection, $query) or die(mysqli_error($connection));

                    // Upload file
                    if (!move_uploaded_file($_FILES['file']['tmp_name'], 'profilePhoto/' . $newName)) {
                        echo '
                    <script type="text/javascript">
                    alert("La foto non è stata caricata");
                    </script>
                    ';
                    }
                }
            }
            /************************* upload ID photo script **************************/

            if (!$result) {
                echo "<script type='text/javascript'>";
                echo "alert('L\'utente non è stato creato!')";
                echo "</script>";
            } else {
                echo "<script type='text/javascript'>";
                echo "alert('L\'utente è stato creato!')";
                echo "</script>";
            }
        }
    }
}
//******************crea user function****************/

//******************modifica user function****************/
function modificaUser()
{
    global $connection;
    $submit = $_POST['submit'];
    $id = $_POST['consulente'];

    $username = $_POST['username'];
    $password = $_POST['password'];

    $nome = $_POST['name'];
    $nome = str_replace(array("'", "’"), array("\'", "\'"), $nome);
    $cognome = $_POST['lastname'];
    $cognome = str_replace(array("'", "’"), array("\'", "\'"), $cognome);

    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $citta = $_POST['citta'];
    $citta = str_replace(array("'", "’"), array("\'", "\'"), $citta);
    $provincia = $_POST['provincia'];
    $provincia = str_replace(array("'", "’"), array("\'", "\'"), $provincia);
    $regione = $_POST['regione'];
    $regione = str_replace(array("'", "’"), array("\'", "\'"), $regione);

    $citta_due = $_POST['citta_due'];
    $citta_due = str_replace(array("'", "’"), array("\'", "\'"), $citta_due);
    $provincia_due = $_POST['provincia_due'];
    $provincia_due = str_replace(array("'", "’"), array("\'", "\'"), $provincia_due);
    $regione_due = $_POST['regione_due'];
    $regione_due = str_replace(array("'", "’"), array("\'", "\'"), $regione_due);

    if (isset($submit)) {

        $query = "UPDATE user SET username = '$username', password = '$password', name = '$nome', lastname = '$cognome', email = '$email', phone = '$phone', citta = '$citta', provincia = '$provincia', regione = '$regione', citta_due = '$citta_due', provincia_due = '$provincia_due', regione_due = '$regione_due' WHERE id = '$id'";
        $result = mysqli_query($connection, $query);

        if ($_FILES['file']['name'] != "") {
            /************************* upload ID photo script **************************/

            //delete old photo profilePhoto
            $queryPhoto = "SELECT id, foto_nome FROM fotoProfile WHERE user_id = '$id'";
            $resultPhoto = mysqli_query($connection, $queryPhoto);
            $rowPhoto = mysqli_fetch_assoc($resultPhoto);
            $photoId = $rowPhoto['id'];
            $photoName = $rowPhoto['foto_nome'];

            $filename = 'profilePhoto/' . $photoName;
            if (file_exists($filename)) {
                $deletePhoto = "DELETE FROM fotoProfile WHERE id = '$photoId'";
                $resultDelete = mysqli_query($connection, $deletePhoto);
                unlink($filename);
            }
            // /.end/ delete old photo profilePhoto

            $query_username = "SELECT id, username FROM user WHERE id = '$id'";
            $result_username = mysqli_query($connection, $query_username);
            $row_username = mysqli_fetch_assoc($result_username);
            $user_username = $row_username['username'];
            $user_userid = $row_username['id'];

            $name = $_FILES['file']['name'];
            $target_dir = "profilePhoto/";
            $target_file = $target_dir . basename($_FILES["file"]["name"]);

            // Select file type
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            // Valid file extensions
            $extensions_arr = array("jpg", "jpeg", "png");

            // Check extension
            if (in_array($imageFileType, $extensions_arr)) {

                $newName = $user_username . '.' . $imageFileType;

                // Insert record
                $query = "insert into fotoProfile (foto_nome,user_id) values ('" . $newName . "','" . $user_userid . "')";

                mysqli_query($connection, $query) or die(mysqli_error($connection));

                // Upload file
                if (!move_uploaded_file($_FILES['file']['tmp_name'], 'profilePhoto/' . $newName)) {
                    echo '
                <script type="text/javascript">
                alert("La foto non è stata caricata");
                </script>
                ';
                }
            }
        }
        // /.end new photo upload/
        /************************* upload ID photo script **************************/

        if (!$result) {
            echo "<script type='text/javascript'>";
            echo "alert('L\'utente non è stato modificato!')";
            echo "</script>";
            echo mysqli_error($connection);
            exit;
        } else {
            echo "<script type='text/javascript'>";
            echo "alert('L\'utente è stato modificato!')";
            echo "</script>";
        }
    }
}

//******************modifica user function****************/

//******************delete user function****************/
function deleteUser()
{
    if (isset($_POST['elimina'])) {
        global $connection;
        $id = $_POST['consulenteElimina'];

        $query = "DELETE FROM user WHERE id = '$id'";
        $result = mysqli_query($connection, $query);

        if ($result) {
            echo "<script type='text/javascript'>";
            echo "alert('L\'utente è stato eleminato!')";
            echo "</script>";
        } else {
            echo "<script type='text/javascript'>";
            echo "alert('L\'utente non è stato eleminato!')";
            echo "</script>";
        }
    }
}
//******************delete user function****************/

//******************crea specializzazioni function****************/
function creaSpecializzazioni()
{
    $submit = $_POST['submit'];
    if (isset($submit)) {
        global $connection;
        $specializzazioni = $_POST['specializzazioni'];
        $specializzazioni = str_replace(array("'", "’"), array("\'", "\'"), $specializzazioni);

        $query = "INSERT INTO specializzazioni (specializzazioni) VALUES ('$specializzazioni')";
        $result = mysqli_query($connection, $query);

        if (!$result) {
            echo "<script type='text/javascript'>";
            echo "alert('La specializzazione non è stata creata!')";
            echo "</script>";
        } else {
            echo "<script type='text/javascript'>";
            echo "alert('La specializzazione è stata creata!')";
            echo "</script>";
        }
    }
}
//******************crea specializzazioni function****************/

//******************crea consulente function****************/
function creaConsulente()
{
    if (isset($_POST['submit'])) {
        global $connection;
        $consulente = $_POST['consulente'];
        $specializzazione = $_POST['specializzazione'];
        if (!empty($consulente)) {


            $specDescription = $_POST['specDescription'];
            for ($i = 0; $i < count($specializzazione); $i++) {
                $queryCheck = "SELECT * FROM consulente WHERE consulente = '$consulente' AND specializzazioni = '$specializzazione[$i]' AND input = '$specDescription[$i]'";
                $resultCheck = mysqli_query($connection, $queryCheck);
                $count = mysqli_num_rows($resultCheck);
            }

            if ($count > 0) {
                echo "<script type='text/javascript'>";
                echo "alert('Il consulente non è stato creato perché hai selezionato le stesse specializzazioni!')";
                echo "</script>";
            } else {
                for ($i = 0; $i < count($specializzazione); $i++) {
                    $specDescription[$i] = str_replace(array("'", "’"), array("\'", "\'"), $specDescription[$i]);
                    $query = "INSERT INTO consulente (consulente, specializzazioni, input) VALUES ('$consulente', '$specializzazione[$i]', '$specDescription[$i]')";
                    $result = mysqli_query($connection, $query);
                }
            }

            if (!$result) {
                echo "<script type='text/javascript'>";
                echo "alert('Il consulente non è stato creato!')";
                echo "</script>";
            } else {
                echo "<script type='text/javascript'>";
                echo "alert('Il consulente è stato creato con successo!')";
                echo "</script>";
            }
        } else {
            echo "<script type='text/javascript'>";
            echo "alert('Il consulente non dovrebbe essere vuoto!')";
            echo "</script>";
        }
    }
}
//******************crea consulente function****************/

//******************modifica consulente function****************/
function modificaConsulente()
{
    global $connection;
    if (isset($_POST['submit'])) {
        $input = $_POST['input'];
        $id = $_POST['id'];
        $specializzazione = $_POST['specializzazione'];
        //$consulente = $_POST['consulente'];

        for ($i = 0; $i < count($input); $i++) {
            $input[$i] = str_replace(array("'", "’"), array("\'", "\'"), $input[$i]);
            $query = "UPDATE consulente SET input = '$input[$i]', specializzazioni = '$specializzazione[$i]' WHERE id = '$id[$i]' ";
            $result = mysqli_query($connection, $query);
        }
        if (!$result) {
            echo "<script type='text/javascript'>";
            echo "alert('Il consulente non è stato modificato!')";
            echo "</script>";
        } else {
            echo "<script type='text/javascript'>";
            echo "alert('Il consulente è stato modificato!')";
            echo "</script>";
        }
    }
}

//******************modifica consulente function****************/

//****************** email form ****************/

function emailForm()
{
    global $connection;
    if (isset($_POST['invia'])) {
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $telefono = $_POST['telefono'];
        $citta = $_POST['citta'];

        $messagio = $_POST['messagio'];
        $messagio = str_replace(array("'", "’"), array("\'", "\'"), $messagio);

        $idConsulente = $_POST['idConsulente'];

        //get consulente name,lastname
        $consulente = "SELECT name,lastname FROM user WHERE id = '$idConsulente'";
        $resultConsulente = mysqli_query($connection, $consulente);
        $rowConsulente = mysqli_fetch_assoc($resultConsulente);
        $fullName = $rowConsulente['name'] . ' ' . $rowConsulente['lastname'];

        //insert into database
        $query = "INSERT INTO emailForm (nome_clienti, email_clienti, telefono_clienti, citta_clienti, messagio_clienti, id_consulenti) VALUES ('$nome', '$email', '$telefono', '$citta', '$messagio', '$idConsulente')";
        $result = mysqli_query($connection, $query);

        function setFilter($val)
        {
            $step1 = trim($val);
            $step2 = strip_tags($step1);
            $step3 = htmlspecialchars($step2, ENT_QUOTES);
            $result = $step3;
            return $result;
        }

        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = 0;
            // (0): Disable debugging (you can also leave this out completely, 0 is the default).
            // (1): Output messages sent by the client.
            // (2): as 1, plus responses received from the server (this is the most useful setting).
            // (3): as 2, plus more information about the initial connection - this level can help diagnose STARTTLS failures.
            // (4): as 3, plus even lower-level information, very verbose, don't use for debugging SMTP, only low-level problems.

            $mail->isSMTP();
            $mail->Host = 'mail.consulentiaziendaliditalia.it';
            $mail->CharSet = "utf-8";
            $mail->SMTPAuth = true;
            $mail->Username = 'network@consulentiaziendaliditalia.it';
            $mail->Password = 'consnet#098';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;
            $mail->SMTPOptions = array(
                'ssl' => [
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true,
                ],
            );

            // Content
            $mail->isHTML(true);

            $subject = "Nuova richiesta di contatto per il consulente " . $fullName . "";
            $mail->Subject = $subject;

            $mail->Body = "
            <h2>Nuova richiesta di contatto per il consulente " . $fullName . "</h2>
            <br>
            <table style='border-collapse: collapse;width: 100%; border: 1px solid #ddd'>
            <thead style='padding-top: 12px;padding-bottom: 12px;text-align: left;background-color: #4CAF50;color: white;'>
           <tr>
           <th>Nome del cliente</th>
           <th>Email</th>
           <th>Telefono</th>
           <th>Città</th>
           <th>Messagio</th>
           <th>Consulente</th>
           </tr>
           </head>
            <tbody>
            <tr>
            <td style='border: 1px solid #ddd; padding: 8px; width: 15%;'>" . $nome . "</td>
            <td style='border: 1px solid #ddd; padding: 8px; width: 10%;'>" . $email . "</td>
            <td style='border: 1px solid #ddd; padding: 8px; width: 10%;'>" . $telefono . "</td>
            <td style='border: 1px solid #ddd; padding: 8px; width: 15%;'>" . $citta . "</td>
            <td style='border: 1px solid #ddd; padding: 8px; width: 25%;'>" . $messagio . "</td>
            <td style='border: 1px solid #ddd; padding: 8px; width: 25%;'>" . $fullName . "</td>
            </tr>
            </body>
            </table>";
            //Recipients
            $mail->setFrom('network@consulentiaziendaliditalia.it', 'Consulenti Aziendali');
            $mail->addAddress('simone.brancozzi@gmail.com ', 'Simone Brancozzi');

            $mail->AltBody = 'Questo è un messaggio informativo.';

            $mail->send();
            echo "<script type='text/javascript'>";
            echo "alert('Abbiamo ricevuto la tua richiesta di contatto. Il consulente da te scelto ti contatterà al più presto!!')";
            echo "</script>";
        } catch (Exception $e) {
            //echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            echo "<script type='text/javascript'>";
            echo "alert('È stato fatto un errore!')";
            echo "</script>";
        }
        //exit;
    }
}

//****************** /.end / email form ****************/