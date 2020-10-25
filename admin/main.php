<?php

if ($xoopsUser) {
    if ($xoopsUser->isAdmin()) {
        function connecte($id)
        {
            global $xoopsConfig, $xoopsUser, $HTTP_REFERER;

            $retour = 0;

            if ($xoopsUser) {
                if ($xoopsUser->isAdmin()) {
                    $retour = 1;
                }
            }

            return $retour;
        }

        function is_editable($fichier)
        {
            $retour = 0;

            if (eregi("\.txt$|\.sql$|\.php$|\.php3$|\.phtml$|\.htm$|\.html$|\.cgi$|\.pl$|\.js$|\.css$|\.inc$", $fichier)) {
                $retour = 1;
            }

            return $retour;
        }

        function is_image($fichier)
        {
            $retour = 0;

            if (eregi("\.png$|\.bmp$|\.jpg$|\.jpeg$|\.gif$", $fichier)) {
                $retour = 1;
            }

            return $retour;
        }

        function taille($fichier)
        {
            global $size_unit;

            $size_unit = 'B';

            $taille = filesize($fichier);

            if ($taille >= 1073741824) {
                $taille = round($taille / 1073741824 * 100) / 100 . ' G' . $size_unit;
            } elseif ($taille >= 1048576) {
                $taille = round($taille / 1048576 * 100) / 100 . ' M' . $size_unit;
            } elseif ($taille >= 1024) {
                $taille = round($taille / 1024 * 100) / 100 . ' K' . $size_unit;
            } else {
                $taille .= ' bytes';
            }

            if (0 == $taille) {
                $taille = '-';
            }

            return $taille;
        }

        function date_modif($fichier)
        {
            $tmp = filemtime($fichier);

            return date('d/m/Y H:i', $tmp);
        }

        function mimetype($fichier, $quoi)
        {
            global $xoopsConfig, $HTTP_USER_AGENT;

            if (!eregi('MSIE', $HTTP_USER_AGENT)) {
                $client = 'netscape.png';
            } else {
                $client = 'html.png';
            }

            if (is_dir($fichier)) {
                $image = 'dossier.png';

                $nom_type = '' . _Directory . '';
            } else {
                if (eregi("\.mid$", $fichier)) {
                    $image = 'mid.png';

                    $nom_type = '' . _MidiFile . '';
                } else {
                    if (eregi("\.txt$", $fichier)) {
                        $image = 'txt.png';

                        $nom_type = '' . _Textfile . '';
                    } else {
                        if (eregi("\.sql$", $fichier)) {
                            $image = 'txt.png';

                            $nom_type = '' . _Textfile . '';
                        } else {
                            if (eregi("\.js$", $fichier)) {
                                $image = 'js.png';

                                $nom_type = '' . _Javascript . '';
                            } else {
                                if (eregi("\.gif$", $fichier)) {
                                    $image = 'gif.png';

                                    $nom_type = '' . _GIFpicture . '';
                                } else {
                                    if (eregi("\.jpg$", $fichier)) {
                                        $image = 'jpg.png';

                                        $nom_type = '' . _JPGpicture . '';
                                    } else {
                                        if (eregi("\.html$", $fichier)) {
                                            $image = $client;

                                            $nom_type = '' . _HTMLpage . '';
                                        } else {
                                            if (eregi("\.htm$", $fichier)) {
                                                $image = $client;

                                                $nom_type = '' . _HTMLpage . '';
                                            } else {
                                                if (eregi("\.rar$", $fichier)) {
                                                    $image = 'rar.png';

                                                    $nom_type = '' . RARFile . '';
                                                } else {
                                                    if (eregi("\.gz$", $fichier)) {
                                                        $image = 'zip.png';

                                                        $nom_type = '' . _GZFile . '';
                                                    } else {
                                                        if (eregi("\.tgz$", $fichier)) {
                                                            $image = 'zip.png';

                                                            $nom_type = '' . _GZFile . '';
                                                        } else {
                                                            if (eregi("\.z$", $fichier)) {
                                                                $image = 'zip.png';

                                                                $nom_type = '' . _GZFile . '';
                                                            } else {
                                                                if (eregi("\.ra$", $fichier)) {
                                                                    $image = 'ram.png';

                                                                    $nom_type = '' . _REALfile . '';
                                                                } else {
                                                                    if (eregi("\.ram$", $fichier)) {
                                                                        $image = 'ram.png';

                                                                        $nom_type = '' . _REALfile . '';
                                                                    } else {
                                                                        if (eregi("\.rm$", $fichier)) {
                                                                            $image = 'ram.png';

                                                                            $nom_type = '' . _REALfile . '';
                                                                        } else {
                                                                            if (eregi("\.pl$", $fichier)) {
                                                                                $image = 'pl.png';

                                                                                $nom_type = '' . _PERLscript . '';
                                                                            } else {
                                                                                if (eregi("\.zip$", $fichier)) {
                                                                                    $image = 'zip.png';

                                                                                    $nom_type = '' . _ZIPfile . '';
                                                                                } else {
                                                                                    if (eregi("\.wav$", $fichier)) {
                                                                                        $image = 'wav.png';

                                                                                        $nom_type = '' . _WAVfile . '';
                                                                                    } else {
                                                                                        if (eregi("\.php$", $fichier)) {
                                                                                            $image = 'php.png';

                                                                                            $nom_type = '' . _PHPscript . '';
                                                                                        } else {
                                                                                            if (eregi("\.php3$", $fichier)) {
                                                                                                $image = 'php.png';

                                                                                                $nom_type = '' . _PHPscript . '';
                                                                                            } else {
                                                                                                if (eregi("\.phtml$", $fichier)) {
                                                                                                    $image = 'php.png';

                                                                                                    $nom_type = '' . _PHPscript . '';
                                                                                                } else {
                                                                                                    if (eregi("\.exe$", $fichier)) {
                                                                                                        $image = 'exe.png';

                                                                                                        $nom_type = '' . _Exefile . '';
                                                                                                    } else {
                                                                                                        if (eregi("\.bmp$", $fichier)) {
                                                                                                            $image = 'bmp.png';

                                                                                                            $nom_type = '' . _BMPpicture . '';
                                                                                                        } else {
                                                                                                            if (eregi("\.png$", $fichier)) {
                                                                                                                $image = 'gif.png';

                                                                                                                $nom_type = '' . _PNGpicture . '';
                                                                                                            } else {
                                                                                                                if (eregi("\.css$", $fichier)) {
                                                                                                                    $image = 'css.png';

                                                                                                                    $nom_type = '' . _CSSFile . '';
                                                                                                                } else {
                                                                                                                    if (eregi("\.mp3$", $fichier)) {
                                                                                                                        $image = 'mp3.png';

                                                                                                                        $nom_type = '' . _MP3File . '';
                                                                                                                    } else {
                                                                                                                        if (eregi("\.xls$", $fichier)) {
                                                                                                                            $image = 'xls.png';

                                                                                                                            $nom_type = '' . _XLSFile . '';
                                                                                                                        } else {
                                                                                                                            if (eregi("\.doc$", $fichier)) {
                                                                                                                                $image = 'doc.png';

                                                                                                                                $nom_type = '' . _WordFile . '';
                                                                                                                            } else {
                                                                                                                                if (eregi("\.pdf$", $fichier)) {
                                                                                                                                    $image = 'pdf.png';

                                                                                                                                    $nom_type = '' . _PDFFile . '';
                                                                                                                                } else {
                                                                                                                                    if (eregi("\.mov$", $fichier)) {
                                                                                                                                        $image = 'mov.png';

                                                                                                                                        $nom_type = '' . _MOVFile . '';
                                                                                                                                    } else {
                                                                                                                                        if (eregi("\.avi$", $fichier)) {
                                                                                                                                            $image = 'avi.png';

                                                                                                                                            $nom_type = '' . _AVIFile . '';
                                                                                                                                        } else {
                                                                                                                                            if (eregi("\.mpg$", $fichier)) {
                                                                                                                                                $image = 'mpg.png';

                                                                                                                                                $nom_type = '' . _MPGFile . '';
                                                                                                                                            } else {
                                                                                                                                                if (eregi("\.mpeg$", $fichier)) {
                                                                                                                                                    $image = 'mpeg.png';

                                                                                                                                                    $nom_type = '' . _MPEGFile . '';
                                                                                                                                                } else {
                                                                                                                                                    if (eregi("\.swf$", $fichier)) {
                                                                                                                                                        $image = 'flash.png';

                                                                                                                                                        $nom_type = '' . _FLASHFile . '';
                                                                                                                                                    } else {
                                                                                                                                                        $image = 'defaut.png';

                                                                                                                                                        $nom_type = '' . _File . '';
                                                                                                                                                    }
                                                                                                                                                }
                                                                                                                                            }
                                                                                                                                        }
                                                                                                                                    }
                                                                                                                                }
                                                                                                                            }
                                                                                                                        }
                                                                                                                    }
                                                                                                                }
                                                                                                            }
                                                                                                        }
                                                                                                    }
                                                                                                }
                                                                                            }
                                                                                        }
                                                                                    }
                                                                                }
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }

            if ('image' == $quoi) {
                return $image;
            }

            return $nom_type;
        }

        function init($rep)
        {
            global $sens, $xoopsConfig;

            if ('' == $rep) {
                $nom_rep = XOOPS_ROOT_PATH;
            }

            if ('' == $sens) {
                $sens = 1;
            } else {
                if (1 == $sens) {
                    $sens = 0;
                } else {
                    $sens = 1;
                }
            }

            if ('' != $rep) {
                $nom_rep = '' . XOOPS_ROOT_PATH . "/$rep";
            }

            if (!file_exists(XOOPS_ROOT_PATH)) {
                echo '<font size="2">' . _pathcorrect . '<br><br><a href="index.php">' . _Goback . "</a></font>\n";

                exit;
            }

            if (!is_dir($nom_rep)) {
                echo '<font size="2">' . _removed . '<br><br><a href="javascript:window.history.back()">' . _Goback . "</a></font>\n";

                exit;
            }

            return $nom_rep;
        }

        function assemble_tableaux($t1, $t2)
        {
            global $sens;

            if (0 == $sens) {
                $tab1 = $t1;

                $tab2 = $t2;
            } else {
                $tab1 = $t2;

                $tab2 = $t1;
            }

            if (is_array($tab1)) {
                while (list($cle, $val) = each($tab1)) {
                    $liste[$cle] = $val;
                }
            }

            if (is_array($tab2)) {
                while (list($cle, $val) = each($tab2)) {
                    $liste[$cle] = $val;
                }
            }

            return $liste;
        }

        function txt_vers_html($chaine)
        {
            $chaine = str_replace('&#8216;', "'", $chaine);

            $chaine = str_replace('&#339;', 'oe', $chaine);

            $chaine = str_replace('&#8217;', "'", $chaine);

            $chaine = str_replace('&#8230;', '...', $chaine);

            $chaine = str_replace('&', '&amp;', $chaine);

            $chaine = str_replace('<', '&lt;', $chaine);

            $chaine = str_replace('>', '&gt;', $chaine);

            $chaine = str_replace('"', '&quot;', $chaine);

            $chaine = str_replace('à', '&agrave;', $chaine);

            $chaine = str_replace('é', '&eacute;', $chaine);

            $chaine = str_replace('è', '&egrave;', $chaine);

            $chaine = str_replace('ù', '&ugrave;', $chaine);

            $chaine = str_replace('â', '&acirc;', $chaine);

            $chaine = str_replace('ê', '&ecirc;', $chaine);

            $chaine = str_replace('î', '&icirc;', $chaine);

            $chaine = str_replace('ô', '&ocirc;', $chaine);

            $chaine = str_replace('û', '&ucirc;', $chaine);

            $chaine = str_replace('ä', '&auml;', $chaine);

            $chaine = str_replace('ë', '&euml;', $chaine);

            $chaine = str_replace('ï', '&iuml;', $chaine);

            $chaine = str_replace('ö', '&ouml;', $chaine);

            $chaine = str_replace('ü', '&uuml;', $chaine);

            return $chaine;
        }

        function show_hidden_files($fichier)
        {
            global $showhidden;

            $showhidden = 1;

            $retour = 1;

            if ('.' == mb_substr($fichier, 0, 1) && 0 == $showhidden) {
                $retour = 0;
            }

            return $retour;
        }

        function listing($nom_rep)
        {
            global $sens, $ordre, $size_unit;

            $poidstotal = 0;

            $handle = opendir($nom_rep);

            while ($fichier = readdir($handle)) {
                if ('.' != $fichier && '..' != $fichier && 1 == show_hidden_files($fichier)) {
                    $poidsfic = filesize("$nom_rep/$fichier");

                    $poidstotal += $poidsfic;

                    if (is_dir("$nom_rep/$fichier")) {
                        if ('mod' == $ordre) {
                            $liste_rep[$fichier] = filemtime("$nom_rep/$fichier");
                        } else {
                            $liste_rep[$fichier] = $fichier;
                        }
                    } else {
                        if ('nom' == $ordre) {
                            $liste_fic[$fichier] = mimetype("$nom_rep/$fichier", 'image');
                        } else {
                            if ('taille' == $ordre) {
                                $liste_fic[$fichier] = $poidsfic;
                            } else {
                                if ('mod' == $ordre) {
                                    $liste_fic[$fichier] = filemtime("$nom_rep/$fichier");
                                } else {
                                    if ('type' == $ordre) {
                                        $liste_fic[$fichier] = mimetype("$nom_rep/$fichier", 'type');
                                    } else {
                                        $liste_fic[$fichier] = mimetype("$nom_rep/$fichier", 'image');
                                    }
                                }
                            }
                        }
                    }
                }
            }

            closedir($handle);

            if (is_array($liste_fic)) {
                if ('nom' == $ordre) {
                    if (0 == $sens) {
                        ksort($liste_fic);
                    } else {
                        krsort($liste_fic);
                    }
                } else {
                    if ('mod' == $ordre) {
                        if (0 == $sens) {
                            arsort($liste_fic);
                        } else {
                            asort($liste_fic);
                        }
                    } else {
                        if ('taille' == $ordre || 'type' == $ordre) {
                            if (0 == $sens) {
                                asort($liste_fic);
                            } else {
                                arsort($liste_fic);
                            }
                        } else {
                            if (0 == $sens) {
                                ksort($liste_fic);
                            } else {
                                krsort($liste_fic);
                            }
                        }
                    }
                }
            }

            if (is_array($liste_rep)) {
                if ('mod' == $ordre) {
                    if (0 == $sens) {
                        arsort($liste_rep);
                    } else {
                        asort($liste_rep);
                    }
                } else {
                    if (0 == $sens) {
                        ksort($liste_rep);
                    } else {
                        krsort($liste_rep);
                    }
                }
            }

            $liste = assemble_tableaux($liste_rep, $liste_fic);

            if ($poidstotal >= 1073741824) {
                $poidstotal = round($poidstotal / 1073741824 * 100) / 100 . ' G' . $size_unit;
            } elseif ($poidstotal >= 1048576) {
                $poidstotal = round($poidstotal / 1048576 * 100) / 100 . ' M' . $size_unit;
            } elseif ($poidstotal >= 1024) {
                $poidstotal = round($poidstotal / 1024 * 100) / 100 . ' K' . $size_unit;
            } else {
                $poidstotal .= ' ' . $size_unit;
            }

            return [ $liste, $poidstotal ];
        }

        function barre_outil($revenir)
        {
            global $id, $ordre, $sens, $xoopsUser, $xoopsConfig, $rep;

            echo "<table width=\"100%\"><tr><td><b><font size=\"2\">\n";

            if (0 == $revenir) {
                echo "<img src=\"images/dossier.png\" width=\"20\" height=\"20\" align=\"ABSMIDDLE\">\n";
            }

            echo '<a href="';

            if (1 == $revenir) {
                echo "index.php?id=$id&ordre=$ordre&sens=$sens&rep=$rep";
            } else {
                echo "index.php?id=$id&ordre=$ordre&sens=$sens";
            }

            echo '">';

            if (1 == $revenir) {
                echo '' . _Goback . '</a>';
            } else {
                echo "$user</a>";

                $array_chemin = preg_split('/', $rep);

                while (list($cle, $val) = each($array_chemin)) {
                    if ('' != $val) {
                        if ('' != $addchemin) {
                            $addchemin .= '/' . $val;
                        } else {
                            $addchemin = $val;
                        }

                        echo "/<a href=\"index.php?id=$id&ordre=$ordre&sens=$sens&rep=$addchemin\">$val</a>";
                    }
                }
            }

            echo '</font></b></td>';

            echo "<td align=\"right\">\n";

            echo '<a href="javascript:location.reload()"><img src="images/refresh.png" alt="' . _Refreshpage . "\" border=\"0\"></a>&nbsp;&nbsp;\n";

            echo "<a href=\"index.php?action=aide&id=$id&ordre=$ordre&sens=$sens&rep=$rep\"><img src=\"images/help.png\" alt=\"" . _Help . "\" border=\"0\"></a>&nbsp;&nbsp;\n";

            if ($xoopsUser) {
                if ($xoopsUser->isAdmin()) {
                    echo '';
                }
            }

            echo "</td></tr></table><br>\n";
        }

        function contenu_dir($nom_rep)
        {
            global $xoopsConfig, $id, $sens, $ordre, $rep, $poidstotal;

            echo "<TABLE  bgcolor=\"white\" border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">\n";

            echo "<tr><td>\n";

            echo "<tr bgcolor=\"#cccccc\">\n";

            if ('' != $rep) {
                $lien = '&rep=' . $rep;
            }

            echo "<td align=\"left\"><b><a href=\"index.php?id=$id&ordre=nom&sens=$sens" . $lien . '"><font size="2">' . _Filename . '</font></a>';

            if ('nom' == $ordre || '' == $ordre) {
                echo "&nbsp;&nbsp;<img src=\"images/fleche${sens}.png\" width=\"10\" height=\"10\">";
            }

            echo "</b></td>\n";

            echo "<td><b><a href=\"index.php?id=$id&ordre=taille&sens=$sens" . $lien . '"><font size="2">' . _fSize . '</font></a>';

            if ('taille' == $ordre) {
                echo "&nbsp;&nbsp;<img src=\"images/fleche${sens}.png\" width=\"10\" height=\"10\">";
            }

            echo "</b></td>\n";

            echo "<td><b><a href=\"index.php?id=$id&ordre=type&sens=$sens" . $lien . '"><font size="2">' . _Type . '</font></a>';

            if ('type' == $ordre) {
                echo "&nbsp;&nbsp;<img src=\"images/fleche${sens}.png\" width=\"10\" height=\"10\">";
            }

            echo "</b></td>\n";

            echo "<td><b><a href=\"index.php?id=$id&ordre=mod&sens=$sens" . $lien . '"><font size="2">' . _Modified . "</font></a>\n";

            if ('mod' == $ordre) {
                echo "&nbsp;&nbsp;<img src=\"images/fleche${sens}.png\" width=\"10\" height=\"10\">";
            }

            echo "</b></td>\n";

            echo '<td align="center"><b><font size="2">' . _Actions . "</font></b></td>\n";

            echo "</tr>\n";

            if (1 == $sens) {
                $sens = 0;
            } else {
                $sens = 1;
            }

            if ('' != $rep) {
                $nom = dirname($rep);

                echo "<tr><td align=\"left\"><a href=\"index.php?id=$id&sens=$sens&ordre=$ordre";

                if ($rep != $nom && '.' != $nom) {
                    echo "&rep=$nom";
                }

                echo '"><img src="images/parent.png" width="20" height="20" align="ABSMIDDLE" border="0"><font size="2">' . _Parentdir . "</font></a></td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>\n";
            }

            [$liste, $poidstotal] = listing($nom_rep);

            if (is_array($liste)) {
                while (list($fichier, $mime) = each($liste)) {
                    if (is_dir("$nom_rep/$fichier")) {
                        $lien = "index.php?id=$id&sens=$sens&ordre=$ordre&rep=";

                        if ('' != $rep) {
                            $lien .= "$rep/";
                        }

                        $lien .= $fichier;

                        $affiche_copier = 'non';
                    } else {
                        $lien = '';

                        if ('' != $rep) {
                            $lien .= "$rep/";
                        }

                        $lien .= $fichier;

                        $lien = "javascript:popup('$lien')";

                        $affiche_copier = 'oui';
                    }

                    echo "<tr>\n";

                    echo "<td align=\"left\" ><font size=\"2\">\n";

                    if (is_editable($fichier) || is_image($fichier) || is_dir("$nom_rep/$fichier")) {
                        echo "<a href=\"$lien\">";
                    }

                    echo '<img src="images/' . mimetype("$nom_rep/$fichier", 'image') . '" width="20" height="20" align="ABSMIDDLE" border="0"> ';

                    echo (string)$fichier;

                    if (is_editable($fichier) || is_image($fichier) || is_dir("$nom_rep/$fichier")) {
                        echo "</a>\n";
                    }

                    echo "</font></td>\n";

                    echo '<td width="11%"><font size="1">' . taille("$nom_rep/$fichier") . "</font></td>\n";

                    echo '<td width="15%"><font size="1">' . mimetype("$nom_rep/$fichier", 'type') . "</font></td>\n";

                    echo '<td width="17%"><font size="1">' . date_modif("$nom_rep/$fichier") . "</font></td>\n";

                    echo '<td width="21%">';

                    if ('oui' == $affiche_copier) {
                        echo "<a href=\"index.php?id=$id&action=copier&sens=$sens&ordre=$ordre&rep=";

                        if ('' != $rep) {
                            echo "$rep&fic=$rep/";
                        } else {
                            echo '&fic=';
                        }

                        echo "$fichier\"><img src=\"images/copier.png\" alt=\"" . _Copy . "\" width=\"22\" height=\"22\" border=\"0\"></a>\n";
                    } else {
                        echo "<img src=\"images/pixel.png\" width=\"22\" height=\"22\">\n";
                    }

                    if ('oui' == $affiche_copier) {
                        echo "<a href=\"index.php?id=$id&action=deplacer&ordre=$ordre&sens=$sens&rep=";

                        if ('' != $rep) {
                            echo "$rep&fic=$rep/";
                        } else {
                            echo '&fic=';
                        }

                        echo "$fichier\"><img src=\"images/deplacer.png\" alt=\"" . _Move . "\" width=\"22\" height=\"22\" border=\"0\"></a>\n";
                    } else {
                        echo "<img src=\"images/pixel.png\" width=\"22\" height=\"22\">\n";
                    }

                    echo "<a href=\"index.php?id=$id&ordre=$ordre&sens=$sens&action=rename&rep=";

                    if ('' != $rep) {
                        echo "$rep&fic=$rep/";
                    } else {
                        echo '&fic=';
                    }

                    echo "$fichier\"><img src=\"images/renommer.png\" alt=\"" . _Rename . "\" width=\"22\" height=\"22\" border=\"0\"></a>\n";

                    echo "<a href=\"index.php?id=$id&action=supprimer&ordre=$ordre&sens=$sens&rep=";

                    if ('' != $rep) {
                        echo "$rep&fic=$rep/";
                    } else {
                        echo '&fic=';
                    }

                    echo "$fichier\"><img src=\"images/supprimer.png\" alt=\"" . _Deletefile . "\" width=\"22\" height=\"22\" border=\"0\"></a>\n";

                    if (is_editable($fichier) && !is_dir('' . XOOPS_ROOT_PATH . "/$fichier")) {
                        echo "<a href=\"index.php?id=$id&ordre=$ordre&sens=$sens&action=editer&rep=";

                        if ('' != $rep) {
                            echo "$rep&fic=$rep/";
                        } else {
                            echo '&fic=';
                        }

                        echo "$fichier\"><img src=\"images/editer.png\" alt=\"" . _Editfile . "\" width=\"22\" height=\"22\" border=\"0\"></a>\n";
                    } else {
                        echo "<img src=\"images/pixel.png\" width=\"22\" height=\"22\">\n";
                    }

                    if ('oui' == $affiche_copier) {
                        echo "<a href=\"index.php?id=$id&action=telecharger&fichier=";

                        if ('' != $rep) {
                            echo "$rep/";
                        }

                        echo "$fichier\">";

                        echo '<img src="images/download.png" alt="' . _Download . "\" width=\"22\" height=\"22\" border=\"0\"></a>\n";
                    }

                    echo "</td>\n";

                    echo "</tr>\n";
                }
            }

            echo "</table>\n";
        }

        function lister_rep($nom_rep)
        {
            global $xoopsConfig, $rep, $sens, $user, $id, $ordre, $poidstotal;

            if (eregi("\.\.", $rep)) {
                $rep = '';
            }

            $nom_rep = init($rep);

            if (1 == $sens) {
                $sens = 0;
            } else {
                $sens = 1;
            }

            barre_outil(0);

            if (1 == $sens) {
                $sens = 0;
            } else {
                $sens = 1;
            }

            echo "<script language=\"javascript\">\n";

            echo "function popup(lien) {\n";

            echo "var fen=window.open('index.php?id=$id&action=voir&fichier='+lien,'filemanager','status=yes,scrollbars=yes,resizable=yes,width=500,height=400');\n";

            echo "}\n";

            echo "</script>\n";

            contenu_dir($nom_rep);

            echo "<TABLE  bgcolor=\"white\" border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">\n";

            echo "<tr class='bg1'>\n";

            echo "<td>&nbsp;</td>\n";

            echo "<td width=\"11%\"><font size=\"1\">$poidstotal</font></td>\n";

            echo "<td width=\"15%\">&nbsp;</td>\n";

            echo "<td width=\"17%\">&nbsp;</td>\n";

            echo "<td width=\"21%\">&nbsp;</td>\n";

            echo "</tr>\n";

            echo "</table>\n<br>";
        }

        function deldir($location)
        {
            if (is_dir($location)) {
                $all = opendir($location);

                while ($file = readdir($all)) {
                    if (is_dir("$location/$file") && '..' != $file && '.' != $file) {
                        deldir("$location/$file");

                        if (file_exists("$location/$file")) {
                            rmdir("$location/$file");
                        }

                        unset($file);
                    } elseif (!is_dir("$location/$file")) {
                        if (file_exists("$location/$file")) {
                            unlink("$location/$file");
                        }

                        unset($file);
                    }
                }

                closedir($all);

                rmdir($location);
            } else {
                if (file_exists((string)$location)) {
                    unlink((string)$location);
                }
            }
        }

        function enlever_controlM($fichier)
        {
            $fic = file($fichier);

            $fp = fopen($fichier, 'wb');

            while (list($cle, $val) = each($fic)) {
                $val = str_replace(chr(10), '', $val);

                $val = str_replace(chr(13), '', $val);

                fwrite($fp, "$val\n");
            }

            fclose($fp);
        }

        function traite_nom_fichier($nom)
        {
            global $max_caracteres;

            $max_caracteres = 30;

            $nom = stripslashes($nom);

            $nom = str_replace("'", '', $nom);

            $nom = str_replace('"', '', $nom);

            $nom = str_replace('"', '', $nom);

            $nom = str_replace('&', '', $nom);

            $nom = str_replace(',', '', $nom);

            $nom = str_replace(';', '', $nom);

            $nom = str_replace('/', '', $nom);

            $nom = str_replace('\\', '', $nom);

            $nom = str_replace('`', '', $nom);

            $nom = str_replace('<', '', $nom);

            $nom = str_replace('>', '', $nom);

            $nom = str_replace(' ', '_', $nom);

            $nom = str_replace(':', '', $nom);

            $nom = str_replace('*', '', $nom);

            $nom = str_replace('|', '', $nom);

            $nom = str_replace('?', '', $nom);

            $nom = str_replace('é', '', $nom);

            $nom = str_replace('è', '', $nom);

            $nom = str_replace('ç', '', $nom);

            $nom = str_replace('@', '', $nom);

            $nom = str_replace('â', '', $nom);

            $nom = str_replace('ê', '', $nom);

            $nom = str_replace('î', '', $nom);

            $nom = str_replace('ô', '', $nom);

            $nom = str_replace('û', '', $nom);

            $nom = str_replace('ù', '', $nom);

            $nom = str_replace('à', '', $nom);

            $nom = str_replace('!', '', $nom);

            $nom = str_replace('§', '', $nom);

            $nom = str_replace('+', '', $nom);

            $nom = str_replace('^', '', $nom);

            $nom = str_replace('(', '', $nom);

            $nom = str_replace(')', '', $nom);

            $nom = str_replace('#', '', $nom);

            $nom = str_replace('=', '', $nom);

            $nom = str_replace('$', '', $nom);

            $nom = str_replace('%', '', $nom);

            $nom = mb_substr($nom, 0, $max_caracteres);

            return $nom;
        }
    } else {
        redirect_header(XOOPS_URL . '/', 3, _NOPERM);

        exit();
    }
}
