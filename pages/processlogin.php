<?php
require('../includes/connection.php');
require('session.php');

if (isset($_POST['btnlogin'])) {
    $users = trim($_POST['user']);
    $upass = trim($_POST['password']);
    $h_upass = sha1($upass);

    if ($upass == '') {
        ?>
        <script type="text/javascript">
            alert("Entrez le mot de passe !");
            window.location = "login.php";
        </script>
        <?php
    } else {
        $sql = "SELECT id_user,u.nom_user,u.GENDER,u.prenom_user,u.email_user,n.niveau, u.statut
                FROM  `utilisateur` u
                JOIN `niveau` n ON u.id_niveau=n.id_niveau
               
                WHERE  `login` ='" . $users . "' AND  `PASSWORD` =  '" . $h_upass . "'";

        $result = $db->query($sql);

        if ($result) {
            if ($result->num_rows > 0) {
                $found_user  = mysqli_fetch_array($result);

                if ($found_user['statut'] == 1) {
                    // L'utilisateur est bloqué
                    ?>
                    <script type="text/javascript">
                        alert("Votre compte est bloqué. Contactez l'administration.");
                        window.location = "index.php";
                    </script>
                    <?php
                } else {
                    // L'utilisateur n'est pas bloqué, continue le processus de connexion
                    $_SESSION['MEMBER_ID'] = $found_user['id_user'];
                    $_SESSION['nom_user'] = $found_user['nom_user'];
                    $_SESSION['prenom_user'] =  $found_user['prenom_user'];
                    $_SESSION['GENDER'] =  $found_user['GENDER'];
                    $_SESSION['email_user'] =  $found_user['email_user'];
                    $_SESSION['niveau'] =  $found_user['niveau'];

                    // Redirection en fonction du niveau de l'utilisateur
                    switch ($_SESSION['niveau']) {
                        case 'Administrateur Local':
                            if (!isset($_SESSION['premiere_connexion_admin_local'])) {
                                // Marquer la première connexion
                                $_SESSION['premiere_connexion_admin_local'] = true;
                                header('Location: parametrage.php');
                                exit;
                            } else {
                                header('Location: index.php');
                                exit;
                            }
                            break;
                        case 'Censeur':
                            ?>
                            <script type="text/javascript">
                                alert("Censeur <?php echo $_SESSION['nom_user']; ?> Bienvenu!");
                                window.location = "index_cens.php";
                            </script>
                            <?php
                            break;
                            case 'Comptable':
                                ?>
                                <script type="text/javascript">
                                    alert("Econome <?php echo $_SESSION['nom_user']; ?> Bienvenu!");
                                    window.location = "index_compt.php";
                                </script>
                                <?php
                                break;
                                case 'Bibliotheque':
                                    ?>
                                    <script type="text/javascript">
                                        alert("Bibliothecaire <?php echo $_SESSION['nom_user']; ?> Bienvenu!");
                                        window.location = "index_bibli.php";
                                    </script>
                                    <?php
                                    break;
                                    case 'Administrateur Principal':
                                        ?>
                                        <script type="text/javascript">
                                            alert("Administrateur Principal <?php echo $_SESSION['nom_user']; ?> Bienvenu!");
                                            window.location = "index_minis.php";
                                        </script>
                                        <?php
                                        break;
                                        case 'Parent':
                                            ?>
                                            <script type="text/javascript">
                                                alert("Cher(e) M.ou Madame <?php echo $_SESSION['nom_user']; ?> Bienvenu!");
                                                window.location = "index_parent.php";
                                            </script>
                                            <?php
                                            break; 
                                            case 'Professeur':
                                                ?>
                                                <script type="text/javascript">
                                                    alert("Professeur <?php echo $_SESSION['nom_user']; ?> Bienvenu!");
                                                    window.location = "index_prof.php";
                                                </script>
                                                <?php
                                                break;
                                                case 'Proviseur':
                                                    ?>
                                                    <script type="text/javascript">
                                                        alert("Proviseur <?php echo $_SESSION['nom_user']; ?> Bienvenu!");
                                                        window.location = "index_provi.php";
                                                    </script>
                                                    <?php
                                                    break;
                                                    case 'Secretaire':
                                                        ?>
                                                        <script type="text/javascript">
                                                            alert("Secretaire <?php echo $_SESSION['nom_user']; ?> Bienvenu!");
                                                            window.location = "index_secre.php";
                                                        </script>
                                                        <?php
                                                        break;
                                                        case 'Surveillant':
                                                            ?>
                                                            <script type="text/javascript">
                                                                alert("Surveillant <?php echo $_SESSION['nom_user']; ?> Bienvenu!");
                                                                window.location = "index_surv.php";
                                                            </script>
                                                            <?php
                                                            break;
                                                            case 'Enqueteur':
                                                                ?>
                                                                <script type="text/javascript">
                                                                    alert("Enqueteur <?php echo $_SESSION['nom_user']; ?> Bienvenu!");
                                                                    window.location = "index_enq.php";
                                                                </script>
                                                              
                                                            <?php
                                                            break;
                                                         
                        default:
                            // Redirection par défaut vers index.php
                            header('Location: index.php');
                            exit;
                            break;
                    }
                }
            } else {
                ?>
                <script type="text/javascript">
                    alert("Login ou mot de passe introuvable. Contactez l'administration.");
                    window.location = "index.php";
                </script>
                <?php
            }
        } else {
            echo "Error: " . $sql . "<br>" . $db->error;
        }
    }
    $db->close();
}
?>
