<?php

include 'admin_header.php';
global $xoopsUser;
if ($xoopsUser) {
    if ($xoopsUser->isAdmin()) {
        if ($xoopsUser) {
            if ($xoopsUser->isAdmin()) {
                include 'main.php';
            }
        }

        switch ($action) {
            case 'aide':
                xoops_cp_header();
                OpenTable($width = '98%');
                 barre_outil(1);
                if (file_exists('../language/' . $xoopsConfig['language'] . '/help.htm')) {
                    include '../language/' . $xoopsConfig['language'] . '/help.htm';
                } else {
                    include 'help.htm';
                }
                CloseTable();
                xoops_cp_footer();
                break;
            case 'telecharger':
                $NomFichier = basename($fichier);
                $taille = filesize('' . XOOPS_ROOT_PATH . "/$fichier");
                 header("Content-Type: application/force-download; name=\"$NomFichier\"");
                header('Content-Transfer-Encoding: binary');
                header("Content-Length: $taille");
                header("Content-Disposition: attachment; filename=\"$NomFichier\"");
                header('Expires: 0');
                header('Cache-Control: no-cache, must-revalidate');
                header('Pragma: no-cache');
                readfile('' . XOOPS_ROOT_PATH . "/$fichier");
                exit();
                break;
            case 'editer':
                if (!connecte($id)) {
                    header('Location:index.php');

                    exit;
                }
                $code = stripslashes($code);
                 if (1 == $save) {
                     $code = str_replace('&lt;', '<', $code);

                     $fp = fopen('' . XOOPS_ROOT_PATH . "/$fic", 'wb');

                     fwrite($fp, $code);

                     fclose($fp);

                     enlever_controlM('' . XOOPS_ROOT_PATH . "/$fic");
                 }
                xoops_cp_header();
                OpenTable($width = '98%');
                 echo "<center>\n";
                echo '<font size="2">' . _Save . " <b>$fic</b></font><br>";
                echo "<form action=\"index.php\" method=\"post\">\n";
                echo "<input type=\"hidden\" name=\"id\" value=\"$id\">\n";
                echo "<input type=\"hidden\" name=\"fic\" value=\"$fic\">\n";
                echo "<input type=\"hidden\" name=\"rep\" value=\"$rep\">\n";
                echo "<input type=\"hidden\" name=\"save\" value=\"1\">\n";
                echo "<input type=\"hidden\" name=\"action\" value=\"editer\">\n";
                echo "<input type=\"hidden\" name=\"ordre\" value=\"$ordre\">\n";
                echo "<input type=\"hidden\" name=\"sens\" value=\"$sens\">\n";
                echo "<TEXTAREA NAME=\"code\" rows=\"20\" cols=\"80\" wrap=\"OFF\">\n";
                $fp = fopen('' . XOOPS_ROOT_PATH . "/$fic", 'rb');
                 while (!feof($fp)) {
                     $tmp = fgets($fp, 4096);

                     $tmp = str_replace('<', '&lt;', $tmp);

                     echo (string)$tmp;
                 }
                fclose($fp);
                echo (string)$fichier;
                echo "</TEXTAREA>\n";
                echo "<br><br>\n";
                echo '<input type="image" src="images/enregistrer.png" alt="' . _Save . "\" border=\"0\">\n";
                echo "<a href=\"index.php?id=$id&rep=$rep&ordre=$ordre&sens=$sens\"><img src=\"images/fermer.png\" alt=\"" . _Closepage . "\" border=\"0\"></a>\n";
                echo "</form>\n";
                echo "</center>\n";
                CloseTable();
                xoops_cp_footer();
                break;
            case 'copier':
                if (!connecte($id)) {
                    header('Location:index.php');

                    exit;
                }
                xoops_cp_header();
                OpenTable($width = '98%');
                 echo "<center>\n";
                echo "<table>\n";
                echo '<tr><td><font size="2"><img src="images/copier.png" width="20" height="20" align="ABSMIDDLE"> ' . _Selectedfile . " : </font></td><td><font size=\"2\"><b>$fic</b></font></td></tr>\n";
                echo '<tr><td><font size="2"><img src="images/coller.png" width="20" height="20" align="ABSMIDDLE"> ' . _Pastein . ' : </font></td><td><font size="2">';
                if ('' == $dest) {
                    echo '/';
                } else {
                    echo (string)$dest;
                }
                echo "</font></td></tr>\n";
                echo "</table>\n";
                echo '<br><font size="2">' . _another . " :</font><br>\n";
                echo '<table>';
                $handle = opendir('' . XOOPS_ROOT_PATH . "/$dest");
                while ($fichier = readdir($handle)) {
                    if ('..' == $fichier) {
                        $up = dirname($dest);

                        if ($up == $dest || '.' == $up) {
                            $up = '';
                        }

                        if ($up != $dest) {
                            echo "<td><img src=\"images/parent.png\"></td><td><font size=\"2\"><a href=\"index.php?id=$id&action=copier&ordre=$ordre&sens=$sens&dest=$up&fic=$fic&rep=$rep\">" . _Parentdir . '</font></td>';
                        }
                    } else {
                        if ('..' != $fichier && '.' != $fichier && is_dir('' . XOOPS_ROOT_PATH . "/$dest/$fichier")) {
                            $liste_dir[] = $fichier;
                        }
                    }
                }
                closedir($handle);
                if (is_array($liste_dir)) {
                    asort($liste_dir);

                    while (list($cle, $val) = each($liste_dir)) {
                        echo "<tr><td><img src=\"images/dossier.png\"></td><td><font size=\"2\"><a href=\"index.php?id=$id&action=copier&dest=";

                        if ('' != $dest) {
                            echo "$dest/";
                        }

                        echo "$val&rep=$rep&ordre=$ordre&sens=$sens&fic=$fic\">$val</a></font></tr>\n";
                    }
                }
                echo '</table><br>';
                echo "<table>\n";
                echo "<tr>\n";
                echo "<td>\n";
                echo "<form action=\"index.php\" method=\"post\">\n";
                echo "<input type=\"hidden\" name=\"action\" value=\"copier_suite\">\n";
                echo "<input type=\"hidden\" name=\"fic\" value=\"$fic\">\n";
                echo "<input type=\"hidden\" name=\"dest\" value=\"$dest\">\n";
                echo "<input type=\"hidden\" name=\"rep\" value=\"$rep\">\n";
                echo "<input type=\"hidden\" name=\"id\" value=\"$id\">\n";
                echo "<input type=\"hidden\" name=\"sens\" value=\"$sens\">\n";
                echo "<input type=\"hidden\" name=\"ordre\" value=\"$ordre\">\n";
                echo '<input type="submit" value="&nbsp;&nbsp;&nbsp;' . _Move . "&nbsp;&nbsp;\">&nbsp;\n";
                echo "</form>\n";
                echo "</td>\n";
                echo "<td>\n";
                echo "<form action=\"index.php\" method=\"post\">\n";
                echo "<input type=\"hidden\" name=\"id\" value=\"$id\">\n";
                echo "<input type=\"hidden\" name=\"rep\" value=\"$rep\">\n";
                echo "<input type=\"hidden\" name=\"ordre\" value=\"$ordre\">\n";
                echo "<input type=\"hidden\" name=\"sens\" value=\"$sens\">\n";
                echo '<input type="submit" value="' . _CANCEL . "\">\n";
                echo "</form>\n";
                echo "</td>\n";
                echo "</tr>\n";
                echo "</table>\n";
                echo "</center>\n";
                CloseTable();
                xoops_cp_footer();
                break;
            case 'copier_suite':
                if (!connecte($id)) {
                    header('Location:index.php');

                    exit;
                }
                $destination = '' . XOOPS_ROOT_PATH . '/';
                 if ('' != $dest) {
                     $destination .= "$dest/";
                 }
                $destination .= basename($fic);
                if (file_exists('' . XOOPS_ROOT_PATH . "/$fic") && '' . XOOPS_ROOT_PATH . "/$fic" != $destination) {
                    copy('' . XOOPS_ROOT_PATH . "/$fic", $destination);
                }
                header("Location:index.php?rep=$rep&id=$id&ordre=$ordre&sens=$sens");
                exit;
                break;
            case 'voir':
                $nomdufichier = basename($fichier);
                 echo "<html>\n";
                echo '<head><title>' . _File . ' : ' . $nomdufichier . "</title></head>\n";
                echo '<center><font size="2">' . _File . ' : ';
                echo '<img src="images/' . mimetype('' . XOOPS_ROOT_PATH . "/$fichier", 'image') . "\" align=\"ABSMIDDLE\">\n";
                echo '<b>' . $nomdufichier . "</b></font><br><br><hr>\n";
                echo '<a href="javascript:window.print()"><img src="images/imprimer.png" alt="' . _Print . "\" border=\"0\"></a>\n";
                echo '<a href="javascript:window.close()"><img src="images/fermer.png" alt="' . _Closepage . "\" border=\"0\"></a>\n";
                echo "<br>\n";
                echo '<hr><br>';
                if (!is_image($fichier)) {
                    echo "</center>\n";

                    $fp = @fopen('' . XOOPS_ROOT_PATH . "/$fichier", 'rb');

                    if ($fp) {
                        echo "<font size=\"1\">\n";

                        while (!feof($fp)) {
                            $buffer = fgets($fp, 4096);

                            $buffer = txt_vers_html($buffer);

                            $buffer = str_replace("\t", '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', $buffer);

                            echo $buffer . '<br>';
                        }

                        fclose($fp);

                        echo "</font>\n";
                    } else {
                        echo '<font size="2">' . _Unable . ' : ' . XOOPS_ROOT_PATH . "/$fichier</font>";
                    }

                    echo "<center>\n";
                } else {
                    echo '<img src="' . XOOPS_URL . "/$fichier\">\n";
                }
                echo "<hr>\n";
                echo '<a href="javascript:window.print()"><img src="images/imprimer.png" alt="' . _Print . "\" border=\"0\"></a>\n";
                echo '<a href="javascript:window.close()"><img src="images/fermer.png" alt="' . _Closepage . "\" border=\"0\"></a>\n";
                echo "<hr></center>\n";
                echo "</body>\n";
                echo "</html>\n";
                exit;
                break;
            case 'deplacer':
                xoops_cp_header();
                OpenTable($width = '98%');
                 if (!connecte($id)) {
                     header('Location:index.php');

                     exit;
                 }
                include $hautpage;
                echo "<center>\n";
                echo "<table>\n";
                echo '<tr><td><font size="2"><img src="images/deplacer.png" width="22" height="22" align="ABSMIDDLE"> ' . _Selectedfile . " : </font></td><td><font size=\"2\"><b>$fic</b></font></td></tr>\n";
                echo '<tr><td><font size="2"><img src="images/coller.png" width="20" height="20" align="ABSMIDDLE"> ' . _Pastein . ' : </font></td><td><font size="2">';
                if ('' == $dest) {
                    echo '/';
                } else {
                    echo (string)$dest;
                }
                echo "</font></td></tr>\n";
                echo "</table>\n";
                echo '<br><font size="2">' . _another . " :</font><br>\n";
                echo '<table>';
                $handle = opendir('' . XOOPS_ROOT_PATH . "/$dest");
                while ($fichier = readdir($handle)) {
                    if ('..' == $fichier) {
                        $up = dirname($dest);

                        if ($up == $dest || '.' == $up) {
                            $up = '';
                        }

                        if ($up != $dest) {
                            echo "<td><img src=\"images/parent.png\"></td><td><font size=\"2\"><a href=\"index.php?id=$id&ordre=$ordre&sens=$sens&action=deplacer&dest=$up&fic=$fic&rep=$rep\">" . _Parentdir . '</font>';
                        }
                    } else {
                        if ('..' != $fichier && '.' != $fichier && is_dir('' . XOOPS_ROOT_PATH . "/$dest/$fichier")) {
                            $liste_dir[] = $fichier;
                        }
                    }
                }
                closedir($handle);
                if (is_array($liste_dir)) {
                    asort($liste_dir);

                    while (list($cle, $val) = each($liste_dir)) {
                        echo "<tr><td><img src=\"images/dossier.png\"></td><td><font size=\"2\"><a href=\"index.php?id=$id&action=deplacer&dest=";

                        if ('' != $dest) {
                            echo "$dest/";
                        }

                        echo "$val&rep=$rep&ordre=$ordre&sens=$sens&fic=$fic\">$val</a></font></tr>\n";
                    }
                }
                echo '</table><br>';
                echo "<table>\n";
                echo "<tr>\n";
                echo "<td>\n";
                echo "<form action=\"index.php\" method=\"post\">\n";
                echo "<input type=\"hidden\" name=\"action\" value=\"deplacer_suite\">\n";
                echo "<input type=\"hidden\" name=\"fic\" value=\"$fic\">\n";
                echo "<input type=\"hidden\" name=\"dest\" value=\"$dest\">\n";
                echo "<input type=\"hidden\" name=\"rep\" value=\"$rep\">\n";
                echo "<input type=\"hidden\" name=\"id\" value=\"$id\">\n";
                echo "<input type=\"hidden\" name=\"ordre\" value=\"$ordre\">\n";
                echo "<input type=\"hidden\" name=\"sens\" value=\"$sens\">\n";
                echo '<input type="submit" value="&nbsp;&nbsp;' . _Move . "&nbsp;&nbsp;&nbsp;\">&nbsp;\n";
                echo "</form>\n";
                echo "</td>\n";
                echo "<td>\n";
                echo "<form action=\"index.php\" method=\"post\">\n";
                echo "<input type=\"hidden\" name=\"id\" value=\"$id\">\n";
                echo "<input type=\"hidden\" name=\"rep\" value=\"$rep\">\n";
                echo "<input type=\"hidden\" name=\"ordre\" value=\"$ordre\">\n";
                echo "<input type=\"hidden\" name=\"sens\" value=\"$sens\">\n";
                echo '<input type="submit" value="' . _CANCEL . "\">\n";
                echo "</form>\n";
                echo "</td>\n";
                echo "</tr>\n";
                echo "</table>\n";
                echo "</center>\n";
                CloseTable();
                xoops_cp_footer();
                break;
            case 'deplacer_suite':
                if (!connecte($id)) {
                    header('Location:index.php');

                    exit;
                }
                $destination = '' . XOOPS_ROOT_PATH . '/';
                 if ('' != $dest) {
                     $destination .= "$dest/";
                 }
                $destination .= basename($fic);
                if (file_exists('' . XOOPS_ROOT_PATH . "/$fic") && '' . XOOPS_ROOT_PATH . "/$fic" != $destination) {
                    copy('' . XOOPS_ROOT_PATH . "/$fic", $destination);
                }
                if ('' . XOOPS_ROOT_PATH . "/$fic" != $destination) {
                    if (file_exists('' . XOOPS_ROOT_PATH . "/$fic")) {
                        unlink('' . XOOPS_ROOT_PATH . "/$fic");
                    }
                }
                header("Location:index.php?rep=$rep&ordre=$ordre&sens=$sens&id=$id");
                exit;
                break;
            case 'supprimer':
                xoops_cp_header();
                OpenTable($width = '98%');
                 if (!connecte($id)) {
                     header('Location:index.php');

                     exit;
                 }
                echo "<center>\n";
                if (is_dir('' . XOOPS_ROOT_PATH . "/$fic")) {
                    $mime = '' . _directory . '';
                } else {
                    $mime = '' . _file . '';
                }
                 echo '<font size="2">' . _really . " $mime <b>$fic</b> ?";
                echo '<br><br>';
                echo "<a href=\"index.php?action=supprimer_suite&rep=$rep&fic=$fic&id=$id&ordre=$ordre&sens=$sens\">" . _YES . "</a>&nbsp;&nbsp;&nbsp;\n";
                echo "<a href=\"index.php?rep=$rep&id=$id&ordre=$ordre&sens=$sens\">" . _NO . "</a>\n";
                echo '</font><br>';
                echo "</center>\n";
                CloseTable();
                xoops_cp_footer();
                break;
            case 'supprimer_suite':
                if (!connecte($id)) {
                    header('Location:index.php');

                    exit;
                }
                $messtmp = '<font size="2">';
                $a_effacer = '' . XOOPS_ROOT_PATH . "/$fic";
                 if (file_exists($a_effacer)) {
                     if (is_dir($a_effacer)) {
                         deldir($a_effacer);

                         $messtmp .= "'._Thedirectory.' <b>$fic</b> '._deleted.'";
                     } else {
                         unlink($a_effacer);

                         $messtmp .= "'._Thefile.' <b>$fic</b> '._deleted.'";
                     }
                 } else {
                     $messtmp .= '' . _removed . '';
                 }
                $messtmp .= "<br><br><a href=\"index.php?rep=$rep&id=$id&ordre=$ordre&sens=$sens\">" . _Goback . '</a>';
                $messtmp .= '</font>';
                header("Location:index.php?rep=$rep&id=$id&ordre=$ordre&sens=$sens");
                exit;
                break;
            case 'rename':
                if (!connecte($id)) {
                    header('Location:index.php');

                    exit;
                }
                include $hautpage;
                xoops_cp_header();
                OpenTable($width = '98%');
                 echo "<center>\n";
                $nom_fic = basename($fic);
                 echo '<font size="2">';
                echo "<form action=\"index.php\" method=\"post\">\n";
                echo "<input type=\"hidden\" name=\"action\" value=\"rename_suite\">\n";
                echo "<input type=\"hidden\" name=\"rep\" value=\"$rep\">\n";
                echo "<input type=\"hidden\" name=\"fic\" value=\"$fic\">\n";
                echo "<input type=\"hidden\" name=\"id\" value=\"$id\">\n";
                echo "<input type=\"hidden\" name=\"ordre\" value=\"$ordre\">\n";
                echo "<input type=\"hidden\" name=\"sens\" value=\"$sens\">\n";
                echo '' . _Rename . " <b>$nom_fic</b> " . _to . ' ';
                echo "<input type=\"text\" name=\"fic_new\" value=\"$nom_fic\">\n";
                echo '<input type="submit" value="' . _Rename . "\">\n";
                echo '</form>';
                echo "<a href=\"index.php?rep=$rep&id=$id&ordre=$ordre&sens=$sens\">" . _Goback . '</a>';
                echo '</font><br>';
                echo "</center>\n";
                CloseTable();
                xoops_cp_footer();
                break;
            case 'rename_suite':
                if (!connecte($id)) {
                    header('Location:index.php');

                    exit;
                }
                $err = '';
                $nom_fic = basename($fic);
                $messtmp = '<font size="2">';
                $fic_new = traite_nom_fichier($fic_new);
                $old = '' . XOOPS_ROOT_PATH . "/$fic";
                $new = dirname($old) . '/' . $fic_new;
                 if ('' == $fic_new) {
                     $messtmp .= '' . _validname . '';

                     $err = 1;
                 } else {
                     if (file_exists($new)) {
                         $messtmp .= "<b>$fic_new</b> " . _alreadyexists . '';

                         $err = 1;
                     } else {
                         if (file_exists($old)) {
                             rename($old, $new);
                         }

                         $messtmp .= "<b>$fic</b> " . _renamedto . " <b>$fic_new</b>";
                     }
                 }
                $messtmp .= "<br><br><a href=\"index.php?rep=$rep&id=$id&ordre=$ordre&sens=$sens\">" . _Goback . '</a>';
                $messtmp .= '</font>';
                if ('' == $err) {
                    header("Location:index.php?rep=$rep&ordre=$ordre&sens=$sens&id=$id");

                    exit;
                }
                include $hautpage;
                echo "<center>\n";
                echo (string)$messtmp;
                echo "</center>\n";
                break;
            case 'mkdir':
                if (!connecte($id)) {
                    header('Location:index.php');

                    exit;
                }
                $err = '';
                $messtmp = '<font size="2">';
                $nomdir = traite_nom_fichier($nomdir);
                 if ('' == $nomdir) {
                     $messtmp .= '' . _validname . '';

                     $err = 1;
                 } else {
                     if (file_exists('' . XOOPS_ROOT_PATH . "/$rep/$nomdir")) {
                         $messtmp .= '' . _exists . '';

                         $err = 1;
                     } else {
                         mkdir('' . XOOPS_ROOT_PATH . "/$rep/$nomdir", 0775);

                         $messtmp .= '' . _Thedirectory . " <b>$nomdir</b> " . _createin . ' <b>';

                         if ('' == $rep) {
                             $messtmp .= '/';
                         } else {
                             $messtmp .= (string)$rep;
                         }

                         $messtmp .= '</b>';
                     }
                 }
                $messtmp .= "<br><br><a href=\"index.php?rep=$rep&id=$id&ordre=$ordre&sens=$sens\">" . _Goback . '</a>';
                $messtmp .= '</font>';
                if ('' == $err) {
                    header("Location:index.php?rep=$rep&id=$id&ordre=$ordre&sens=$sens");

                    exit;
                }
                include $hautpage;
                echo "<center>\n";
                echo (string)$messtmp;
                echo "</center>\n";
                break;
            case 'creer_fichier':
                if (!connecte($id)) {
                    header('Location:index.php');

                    exit;
                }
                $err = '';
                $messtmp = '<font size="2">';
                $nomfic = traite_nom_fichier($nomfic);
                 if ('' == $nomfic) {
                     $messtmp .= '' . _validname . '';

                     $err = 1;
                 } else {
                     if (file_exists('' . XOOPS_ROOT_PATH . "/$rep/$nomfic")) {
                         $messtmp .= '' . _exists . '';

                         $err = 1;
                     } else {
                         $fp = fopen('' . XOOPS_ROOT_PATH . "/$rep/$nomfic", 'wb');

                         if (eregi("\.html$", $nomfic) || eregi("\.htm$", $nomfic)) {
                             fwrite($fp, "<html>\n<head>\n<title>Document sans titre</title>\n<meta http-equiv=\"Content-Type\" content=\"text/html; charset=iso-8859-1\">\n</head>\n<body bgcolor=\"#FFFFFF\" text=\"#000000\">\n\n</body>\n</html>\n");
                         }

                         fclose($fp);

                         $messtmp .= '' . _Thefile . " <b>$nomfic</b> " . _createin . ' <b>';

                         if ('' == $rep) {
                             $messtmp .= '/';
                         } else {
                             $messtmp .= (string)$rep;
                         }

                         $messtmp .= '</b>';
                     }
                 }
                $messtmp .= "<br><br><a href=\"index.php?rep=$rep&id=$id&ordre=$ordre&sens=$sens\">" . _Goback . '</a>';
                $messtmp .= '</font>';
                if ('' == $err) {
                    header("Location:index.php?rep=$rep&id=$id&ordre=$ordre&sens=$sens");

                    exit;
                }
                include $hautpage;
                echo "<center>\n";
                echo (string)$messtmp;
                echo "</center>\n";
                break;
            case 'upload':
                if (!connecte($id)) {
                    header('Location:index.php');

                    exit;
                }
                $messtmp = '<font size="2">';
                if ('' != $rep) {
                    $rep_source = "/$rep";
                }
                $destination = '' . XOOPS_ROOT_PATH . (string)$rep_source;
                if (0 != $userfile_size) {
                    $taille_ko = $userfile_size / 1024;
                } else {
                    $taille_ko = 0;
                }
                if ('none' == $userfile) {
                    $message = '' . _select . '';
                }
                 if ('none' != $userfile && 0 != $userfile_size) {
                     $userfile_name = traite_nom_fichier($userfile_name);

                     if (!copy($userfile, "$destination/$userfile_name")) {
                         $message = '<br>' . _Errorup . "<br>$userfile_name";
                     } else {
                         if (is_editable($userfile_name)) {
                             enlever_controlM("$destination/$userfile_name");
                         }

                         $message = '' . _Thefile . " <b>$userfile_name</b> " . _success . " <b>$rep</b>";
                     }
                 }
                $messtmp .= "$message<br>";
                $messtmp .= "<br><br><a href=\"index.php?rep=$rep&id=$id&ordre=$ordre&sens=$sens\">" . _Errorup . '</a>';
                $messtmp .= '</font>';
                header("Location:index.php?rep=$rep&ordre=$ordre&sens=$sens&id=$id");
                exit;
                break;
            case 'deconnexion':
                if (!connecte($id)) {
                    header('Location:index.php');

                    exit;
                }
                if (file_exists("logs/$id.php")) {
                    unlink("logs/$id.php");
                }
                $now = time();
                $eff = $now - (24 * 3600);
                $handle = opendir('logs');
                while ($fichier = readdir($handle)) {
                    if ('.' != $fichier && '..' != $fichier) {
                        $tmp = filemtime("logs/$fichier");

                        if ($tmp < $eff) {
                            unlink("logs/$fichier");
                        }
                    }
                }
                closedir($handle);
                header('Location:index.php');
                break;
            default:
                xoops_cp_header();
                OpenTable($width = '98%');
                 include $hautpage;
                if (!connecte($id)) {
                    redirect_header(XOOPS_URL . '/', 3, _NOPERM);

                    exit();
                }

                    echo "<table bgcolor=\"white\" width=\"100%\" border=\"1\" cellspacing=\"1\" cellpadding=\"5\">\n";
                    echo "<tr>\n";
                    echo "<td colspan=\"2\" align=\"left\"> \n";

                    lister_rep($nom_rep);

                    echo '</td></tr></table>';

                    echo "<table width=\"100%\" border=\"0\" cellspacing=\"2\" cellpadding=\"2\">\n";
                    echo "<tr>\n";
                    echo "<td colspan=\"2\" align=\"left\"><img src=\"images/upload.png\"> \n";
                    echo '<font size=2>' . _Uploaddir . '<b>';
                    if ('' == $rep) {
                        echo '/';
                    } else {
                        echo (string)$rep;
                    }
                    echo "</b></font>\n";
                    echo "</td></tr>\n";
                    echo "<tr><td colspan=\"2\" align=\"left\">\n";
                    echo "<form enctype=\"multipart/form-data\" action=\"index.php\" method=\"post\">\n";
                    echo "&nbsp;&nbsp;\n";
                    echo "<input type=\"file\" name=\"userfile\" size=\"30\">\n";
                    echo "<input type=\"hidden\" name=\"action\" value=\"upload\">\n";
                    echo "<input type=\"hidden\" name=\"id\" value=\"$id\">\n";
                    echo "<input type=\"hidden\" name=\"rep\" value=\"$rep\">\n";
                    echo "<input type=\"hidden\" name=\"ordre\" value=\"$ordre\">\n";
                    echo "<input type=\"hidden\" name=\"sens\" value=\"$sens\">\n";
                    echo '<input type="submit" name="Submit" value="' . _Upload . "\">\n";
                    echo "</form>\n";
                    echo "</td></tr>\n";
                    echo "<tr><td colspan=\"2\" align=\"left\">\n";
                    echo "<img src=\"images/dossier.png\">\n";
                    echo '<font size=2>' . _newdir . '<b>';
                    if ('' == $rep) {
                        echo '/';
                    } else {
                        echo (string)$rep;
                    }
                    echo "</b></font></td></tr>\n";
                    echo "<tr><td colspan=\"2\" align=\"left\">\n";
                    echo "<form method=\"post\" action=\"index.php\">\n";
                    echo "&nbsp;&nbsp;\n";
                    echo "<input type=\"text\" name=\"nomdir\" size=\"30\">\n";
                    echo "<input type=\"hidden\" name=\"rep\" value=\"$rep\">\n";
                    echo "<input type=\"hidden\" name=\"action\" value=\"mkdir\">\n";
                    echo "<INPUT TYPE=\"hidden\" name=\"id\" value=\"$id\">\n";
                    echo "<input type=\"hidden\" name=\"ordre\" value=\"$ordre\">\n";
                    echo "<input type=\"hidden\" name=\"sens\" value=\"$sens\">\n";
                    echo '<input type="submit" name="Submit" value="' . _Create . "\">\n";
                    echo "</form></td></tr>\n";
                    echo "<tr><td colspan=\"2\" align=\"left\">\n";
                    echo "<img src=\"images/defaut.png\" align=\"left\">\n";
                    echo '<font size=2>' . _Createnew . '<b>';
                    if ('' == $rep) {
                        echo '/';
                    } else {
                        echo (string)$rep;
                    }
                    echo "</b></font></td></tr>\n";
                    echo "<tr><td colspan=\"2\" align=\"left\">\n";
                    echo "<form method=\"post\" action=\"index.php\">\n";
                    echo "&nbsp;&nbsp;\n";
                    echo "<input type=\"text\" name=\"nomfic\" size=\"30\">\n";
                    echo "<input type=\"hidden\" name=\"rep\" value=\"$rep\">\n";
                    echo "<input type=\"hidden\" name=\"action\" value=\"creer_fichier\">\n";
                    echo "<INPUT TYPE=\"hidden\" name=\"id\" value=\"$id\">\n";
                    echo "<input type=\"hidden\" name=\"ordre\" value=\"$ordre\">\n";
                    echo "<input type=\"hidden\" name=\"sens\" value=\"$sens\">\n";
                    echo '<input type="submit" name="Submit" value="' . _Create . "\">\n";
                    echo "</form></td></tr>\n";
                    echo '</table>';

                CloseTable();
                xoops_cp_footer();
                break;
        }
    } else {
        global $xoopsConfig;

        redirect_header(XOOPS_URL . '/', 3, _NOPERM);

        exit();
    }
}
