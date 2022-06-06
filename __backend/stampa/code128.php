<?php

/*******************************************************************************
* Credits:
* Script :  PDF_Code128
* Version : 1.2
* Date :    2016-01-31
* Auteur :  Roland Gautier
*
* Version   Date        Detail
* 1.2       2016-01-31  Compatibility with FPDF 1.8
* 1.1       2015-04-10  128 control characters FNC1 to FNC4 accepted
* 1.0       2008-05-20  First release
*
* Code128($x, $y, $code, $w, $h)
*     $x,$y :     angle supérieur gauche du code à barre
*                 upper left corner of the barcode
*     $code :     le code à créer
*                 ascii text to convert to barcode
*     $w :        largeur hors tout du code dans l'unité courante
*                 (prévoir 5 à 15 mm de blanc à droite et à gauche)
*                 barcode total width (current unit)
*                 (keep 5 to 15 mm white on left and right sides)
*     $h :        hauteur hors tout du code dans l'unité courante
*                 barcode total height (current unit)
*
* Commutation des jeux ABC automatique et optimisée
* Automatic and optimized A/B/C sets selection and switching
*
*
*   128 barcode control characters
*   ASCII   Aset            Bset        [ne pas utiliser][do not use]
*   ---------------------------
*   200     FNC3            FNC3
*   201     FNC2            FNC2
*   202     ShiftA          ShiftB
*   203     [SwitchToCset]  [SwitchToCset]
*   204     [SwitchToBset]  FNC4
*   205     FNC4            [SwitchToAset]
*   206     FNC1            FNC1
*******************************************************************************/

require('../../___fpdf/fpdf.php');

class PDF_Code128 extends FPDF {

protected $T128;                                         // Tableau des codes 128
protected $ABCset = "";                                  // jeu des caractères éligibles au C128
protected $Aset = "";                                    // Set A du jeu des caractères éligibles
protected $Bset = "";                                    // Set B du jeu des caractères éligibles
protected $Cset = "";                                    // Set C du jeu des caractères éligibles
protected $SetFrom;                                      // Convertisseur source des jeux vers le tableau
protected $SetTo;                                        // Convertisseur destination des jeux vers le tableau
protected $JStart = array("A"=>103, "B"=>104, "C"=>105); // Caractères de sélection de jeu au début du C128
protected $JSwap = array("A"=>101, "B"=>100, "C"=>99);   // Caractères de changement de jeu

//____________________________ Extension du constructeur _______________________
function __construct($orientation='P', $unit='mm', $format='A4') {

    parent::__construct($orientation,$unit,$format);

    $this->T128[] = array(2, 1, 2, 2, 2, 2);           //0 : [ ]               // composition des caractères
    $this->T128[] = array(2, 2, 2, 1, 2, 2);           //1 : [!]
    $this->T128[] = array(2, 2, 2, 2, 2, 1);           //2 : ["]
    $this->T128[] = array(1, 2, 1, 2, 2, 3);           //3 : [#]
    $this->T128[] = array(1, 2, 1, 3, 2, 2);           //4 : [$]
    $this->T128[] = array(1, 3, 1, 2, 2, 2);           //5 : [%]
    $this->T128[] = array(1, 2, 2, 2, 1, 3);           //6 : [&]
    $this->T128[] = array(1, 2, 2, 3, 1, 2);           //7 : [']
    $this->T128[] = array(1, 3, 2, 2, 1, 2);           //8 : [(]
    $this->T128[] = array(2, 2, 1, 2, 1, 3);           //9 : [)]
    $this->T128[] = array(2, 2, 1, 3, 1, 2);           //10 : [*]
    $this->T128[] = array(2, 3, 1, 2, 1, 2);           //11 : [+]
    $this->T128[] = array(1, 1, 2, 2, 3, 2);           //12 : [,]
    $this->T128[] = array(1, 2, 2, 1, 3, 2);           //13 : [-]
    $this->T128[] = array(1, 2, 2, 2, 3, 1);           //14 : [.]
    $this->T128[] = array(1, 1, 3, 2, 2, 2);           //15 : [/]
    $this->T128[] = array(1, 2, 3, 1, 2, 2);           //16 : [0]
    $this->T128[] = array(1, 2, 3, 2, 2, 1);           //17 : [1]
    $this->T128[] = array(2, 2, 3, 2, 1, 1);           //18 : [2]
    $this->T128[] = array(2, 2, 1, 1, 3, 2);           //19 : [3]
    $this->T128[] = array(2, 2, 1, 2, 3, 1);           //20 : [4]
    $this->T128[] = array(2, 1, 3, 2, 1, 2);           //21 : [5]
    $this->T128[] = array(2, 2, 3, 1, 1, 2);           //22 : [6]
    $this->T128[] = array(3, 1, 2, 1, 3, 1);           //23 : [7]
    $this->T128[] = array(3, 1, 1, 2, 2, 2);           //24 : [8]
    $this->T128[] = array(3, 2, 1, 1, 2, 2);           //25 : [9]
    $this->T128[] = array(3, 2, 1, 2, 2, 1);           //26 : [:]
    $this->T128[] = array(3, 1, 2, 2, 1, 2);           //27 : [;]
    $this->T128[] = array(3, 2, 2, 1, 1, 2);           //28 : [<]
    $this->T128[] = array(3, 2, 2, 2, 1, 1);           //29 : [=]
    $this->T128[] = array(2, 1, 2, 1, 2, 3);           //30 : [>]
    $this->T128[] = array(2, 1, 2, 3, 2, 1);           //31 : [?]
    $this->T128[] = array(2, 3, 2, 1, 2, 1);           //32 : [@]
    $this->T128[] = array(1, 1, 1, 3, 2, 3);           //33 : [A]
    $this->T128[] = array(1, 3, 1, 1, 2, 3);           //34 : [B]
    $this->T128[] = array(1, 3, 1, 3, 2, 1);           //35 : [C]
    $this->T128[] = array(1, 1, 2, 3, 1, 3);           //36 : [D]
    $this->T128[] = array(1, 3, 2, 1, 1, 3);           //37 : [E]
    $this->T128[] = array(1, 3, 2, 3, 1, 1);           //38 : [F]
    $this->T128[] = array(2, 1, 1, 3, 1, 3);           //39 : [G]
    $this->T128[] = array(2, 3, 1, 1, 1, 3);           //40 : [H]
    $this->T128[] = array(2, 3, 1, 3, 1, 1);           //41 : [I]
    $this->T128[] = array(1, 1, 2, 1, 3, 3);           //42 : [J]
    $this->T128[] = array(1, 1, 2, 3, 3, 1);           //43 : [K]
    $this->T128[] = array(1, 3, 2, 1, 3, 1);           //44 : [L]
    $this->T128[] = array(1, 1, 3, 1, 2, 3);           //45 : [M]
    $this->T128[] = array(1, 1, 3, 3, 2, 1);           //46 : [N]
    $this->T128[] = array(1, 3, 3, 1, 2, 1);           //47 : [O]
    $this->T128[] = array(3, 1, 3, 1, 2, 1);           //48 : [P]
    $this->T128[] = array(2, 1, 1, 3, 3, 1);           //49 : [Q]
    $this->T128[] = array(2, 3, 1, 1, 3, 1);           //50 : [R]
    $this->T128[] = array(2, 1, 3, 1, 1, 3);           //51 : [S]
    $this->T128[] = array(2, 1, 3, 3, 1, 1);           //52 : [T]
    $this->T128[] = array(2, 1, 3, 1, 3, 1);           //53 : [U]
    $this->T128[] = array(3, 1, 1, 1, 2, 3);           //54 : [V]
    $this->T128[] = array(3, 1, 1, 3, 2, 1);           //55 : [W]
    $this->T128[] = array(3, 3, 1, 1, 2, 1);           //56 : [X]
    $this->T128[] = array(3, 1, 2, 1, 1, 3);           //57 : [Y]
    $this->T128[] = array(3, 1, 2, 3, 1, 1);           //58 : [Z]
    $this->T128[] = array(3, 3, 2, 1, 1, 1);           //59 : [[]
    $this->T128[] = array(3, 1, 4, 1, 1, 1);           //60 : [\]
    $this->T128[] = array(2, 2, 1, 4, 1, 1);           //61 : []]
    $this->T128[] = array(4, 3, 1, 1, 1, 1);           //62 : [^]
    $this->T128[] = array(1, 1, 1, 2, 2, 4);           //63 : [_]
    $this->T128[] = array(1, 1, 1, 4, 2, 2);           //64 : [`]
    $this->T128[] = array(1, 2, 1, 1, 2, 4);           //65 : [a]
    $this->T128[] = array(1, 2, 1, 4, 2, 1);           //66 : [b]
    $this->T128[] = array(1, 4, 1, 1, 2, 2);           //67 : [c]
    $this->T128[] = array(1, 4, 1, 2, 2, 1);           //68 : [d]
    $this->T128[] = array(1, 1, 2, 2, 1, 4);           //69 : [e]
    $this->T128[] = array(1, 1, 2, 4, 1, 2);           //70 : [f]
    $this->T128[] = array(1, 2, 2, 1, 1, 4);           //71 : [g]
    $this->T128[] = array(1, 2, 2, 4, 1, 1);           //72 : [h]
    $this->T128[] = array(1, 4, 2, 1, 1, 2);           //73 : [i]
    $this->T128[] = array(1, 4, 2, 2, 1, 1);           //74 : [j]
    $this->T128[] = array(2, 4, 1, 2, 1, 1);           //75 : [k]
    $this->T128[] = array(2, 2, 1, 1, 1, 4);           //76 : [l]
    $this->T128[] = array(4, 1, 3, 1, 1, 1);           //77 : [m]
    $this->T128[] = array(2, 4, 1, 1, 1, 2);           //78 : [n]
    $this->T128[] = array(1, 3, 4, 1, 1, 1);           //79 : [o]
    $this->T128[] = array(1, 1, 1, 2, 4, 2);           //80 : [p]
    $this->T128[] = array(1, 2, 1, 1, 4, 2);           //81 : [q]
    $this->T128[] = array(1, 2, 1, 2, 4, 1);           //82 : [r]
    $this->T128[] = array(1, 1, 4, 2, 1, 2);           //83 : [s]
    $this->T128[] = array(1, 2, 4, 1, 1, 2);           //84 : [t]
    $this->T128[] = array(1, 2, 4, 2, 1, 1);           //85 : [u]
    $this->T128[] = array(4, 1, 1, 2, 1, 2);           //86 : [v]
    $this->T128[] = array(4, 2, 1, 1, 1, 2);           //87 : [w]
    $this->T128[] = array(4, 2, 1, 2, 1, 1);           //88 : [x]
    $this->T128[] = array(2, 1, 2, 1, 4, 1);           //89 : [y]
    $this->T128[] = array(2, 1, 4, 1, 2, 1);           //90 : [z]
    $this->T128[] = array(4, 1, 2, 1, 2, 1);           //91 : [{]
    $this->T128[] = array(1, 1, 1, 1, 4, 3);           //92 : [|]
    $this->T128[] = array(1, 1, 1, 3, 4, 1);           //93 : [}]
    $this->T128[] = array(1, 3, 1, 1, 4, 1);           //94 : [~]
    $this->T128[] = array(1, 1, 4, 1, 1, 3);           //95 : [DEL]
    $this->T128[] = array(1, 1, 4, 3, 1, 1);           //96 : [FNC3]
    $this->T128[] = array(4, 1, 1, 1, 1, 3);           //97 : [FNC2]
    $this->T128[] = array(4, 1, 1, 3, 1, 1);           //98 : [SHIFT]
    $this->T128[] = array(1, 1, 3, 1, 4, 1);           //99 : [Cswap]
    $this->T128[] = array(1, 1, 4, 1, 3, 1);           //100 : [Bswap]
    $this->T128[] = array(3, 1, 1, 1, 4, 1);           //101 : [Aswap]
    $this->T128[] = array(4, 1, 1, 1, 3, 1);           //102 : [FNC1]
    $this->T128[] = array(2, 1, 1, 4, 1, 2);           //103 : [Astart]
    $this->T128[] = array(2, 1, 1, 2, 1, 4);           //104 : [Bstart]
    $this->T128[] = array(2, 1, 1, 2, 3, 2);           //105 : [Cstart]
    $this->T128[] = array(2, 3, 3, 1, 1, 1);           //106 : [STOP]
    $this->T128[] = array(2, 1);                       //107 : [END BAR]

    for ($i = 32; $i <= 95; $i++) {                                            // jeux de caractères
        $this->ABCset .= chr($i);
    }
    $this->Aset = $this->ABCset;
    $this->Bset = $this->ABCset;

    for ($i = 0; $i <= 31; $i++) {
        $this->ABCset .= chr($i);
        $this->Aset .= chr($i);
    }
    for ($i = 96; $i <= 127; $i++) {
        $this->ABCset .= chr($i);
        $this->Bset .= chr($i);
    }
    for ($i = 200; $i <= 210; $i++) {                                           // controle 128
        $this->ABCset .= chr($i);
        $this->Aset .= chr($i);
        $this->Bset .= chr($i);
    }
    $this->Cset="0123456789".chr(206);

    for ($i=0; $i<96; $i++) {                                                   // convertisseurs des jeux A & B
        @$this->SetFrom["A"] .= chr($i);
        @$this->SetFrom["B"] .= chr($i + 32);
        @$this->SetTo["A"] .= chr(($i < 32) ? $i+64 : $i-32);
        @$this->SetTo["B"] .= chr($i);
    }
    for ($i=96; $i<107; $i++) {                                                 // contrôle des jeux A & B
        @$this->SetFrom["A"] .= chr($i + 104);
        @$this->SetFrom["B"] .= chr($i + 104);
        @$this->SetTo["A"] .= chr($i);
        @$this->SetTo["B"] .= chr($i);
    }
}

//________________ Fonction encodage et dessin du code 128 _____________________
function Code128($x, $y, $code, $w, $h) {
    $Aguid = "";                                                                      // Création des guides de choix ABC
    $Bguid = "";
    $Cguid = "";
    for ($i=0; $i < strlen($code); $i++) {
        $needle = substr($code,$i,1);
        $Aguid .= ((strpos($this->Aset,$needle)===false) ? "N" : "O");
        $Bguid .= ((strpos($this->Bset,$needle)===false) ? "N" : "O");
        $Cguid .= ((strpos($this->Cset,$needle)===false) ? "N" : "O");
    }

    $SminiC = "OOOO";
    $IminiC = 4;

    $crypt = "";
    while ($code > "") {
                                                                                    // BOUCLE PRINCIPALE DE CODAGE
        $i = strpos($Cguid,$SminiC);                                                // forçage du jeu C, si possible
        if ($i!==false) {
            $Aguid [$i] = "N";
            $Bguid [$i] = "N";
        }

        if (substr($Cguid,0,$IminiC) == $SminiC) {                                  // jeu C
            $crypt .= chr(($crypt > "") ? $this->JSwap["C"] : $this->JStart["C"]);  // début Cstart, sinon Cswap
            $made = strpos($Cguid,"N");                                             // étendu du set C
            if ($made === false) {
                $made = strlen($Cguid);
            }
            if (fmod($made,2)==1) {
                $made--;                                                            // seulement un nombre pair
            }
            for ($i=0; $i < $made; $i += 2) {
                $crypt .= chr(strval(substr($code,$i,2)));                          // conversion 2 par 2
            }
            $jeu = "C";
        } else {
            $madeA = strpos($Aguid,"N");                                            // étendu du set A
            if ($madeA === false) {
                $madeA = strlen($Aguid);
            }
            $madeB = strpos($Bguid,"N");                                            // étendu du set B
            if ($madeB === false) {
                $madeB = strlen($Bguid);
            }
            $made = (($madeA < $madeB) ? $madeB : $madeA );                         // étendu traitée
            $jeu = (($madeA < $madeB) ? "B" : "A" );                                // Jeu en cours

            $crypt .= chr(($crypt > "") ? $this->JSwap[$jeu] : $this->JStart[$jeu]); // début start, sinon swap

            $crypt .= strtr(substr($code, 0,$made), $this->SetFrom[$jeu], $this->SetTo[$jeu]); // conversion selon jeu

        }
        $code = substr($code,$made);                                           // raccourcir légende et guides de la zone traitée
        $Aguid = substr($Aguid,$made);
        $Bguid = substr($Bguid,$made);
        $Cguid = substr($Cguid,$made);
    }                                                                          // FIN BOUCLE PRINCIPALE

    $check = ord($crypt[0]);                                                   // calcul de la somme de contrôle
    for ($i=0; $i<strlen($crypt); $i++) {
        $check += (ord($crypt[$i]) * $i);
    }
    $check %= 103;

    $crypt .= chr($check) . chr(106) . chr(107);                               // Chaine cryptée complète

    $i = (strlen($crypt) * 11) - 8;                                            // calcul de la largeur du module
    $modul = $w/$i;

    for ($i=0; $i<strlen($crypt); $i++) {                                      // BOUCLE D'IMPRESSION
        $c = $this->T128[ord($crypt[$i])];
        for ($j=0; $j<count($c); $j++) {
            $this->Rect($x,$y,$c[$j]*$modul,$h,"F");
            $x += ($c[$j++]+$c[$j])*$modul;
        }
    }
}
}                                                                              // FIN DE CLASSE
////////////////////////////////////////////////////////////////////////////////////////////////
// PDF_Label
//
// Class to print labels in Avery or custom formats
//
// Copyright (C) 2003 Laurent PASSEBECQ (LPA)
// Based on code by Steve Dillon
//
//---------------------------------------------------------------------------------------------
// VERSIONS:
// 1.0: Initial release
// 1.1: + Added unit in the constructor
//      + Now Positions start at (1,1).. then the first label at top-left of a page is (1,1)
//      + Added in the description of a label:
//           font-size : defaut char size (can be changed by calling Set_Char_Size(xx);
//           paper-size: Size of the paper for this sheet (thanx to Al Canton)
//           metric    : type of unit used in this description
//                       You can define your label properties in inches by setting metric to
//                       'in' and print in millimiters by setting unit to 'mm' in constructor
//        Added some formats:
//           5160, 5161, 5162, 5163, 5164: thanks to Al Canton
//           8600                        : thanks to Kunal Walia
//      + Added 3mm to the position of labels to avoid errors
// 1.2: = Bug of positioning
//      = Set_Font_Size modified -> Now, just modify the size of the font
// 1.3: + Labels are now printed horizontally
//      = 'in' as document unit didn't work
// 1.4: + Page scaling is disabled in printing options
// 1.5: + Added 3422 format
// 1.6: + FPDF 1.8 compatibility
////////////////////////////////////////////////////////////////////////////////////////////////

/**
 * PDF_Label - PDF label editing
 * @package PDF_Label
 * @author Laurent PASSEBECQ
 * @copyright 2003 Laurent PASSEBECQ
**/

class PDF_Label extends FPDF {

    // Private properties
    protected $_Margin_Left;        // Left margin of labels
    protected $_Margin_Top;            // Top margin of labels
    protected $_X_Space;            // Horizontal space between 2 labels
    protected $_Y_Space;            // Vertical space between 2 labels
    protected $_X_Number;            // Number of labels horizontally
    protected $_Y_Number;            // Number of labels vertically
    protected $_Width;                // Width of label
    protected $_Height;                // Height of label
    protected $_Line_Height;        // Line height
    protected $_Padding;            // Padding
    protected $_Metric_Doc;            // Type of metric for the document
    protected $_COUNTX;                // Current x position
    protected $_COUNTY;                // Current y position

    // List of label formats
    protected $_Avery_Labels = array(
        '5160' => array('paper-size'=>'letter',    'metric'=>'mm',    'marginLeft'=>1.762,    'marginTop'=>10.7,        'NX'=>3,    'NY'=>10,    'SpaceX'=>3.175,    'SpaceY'=>0,    'width'=>66.675,    'height'=>25.4,        'font-size'=>8),
        '5161' => array('paper-size'=>'letter',    'metric'=>'mm',    'marginLeft'=>0.967,    'marginTop'=>10.7,        'NX'=>2,    'NY'=>10,    'SpaceX'=>3.967,    'SpaceY'=>0,    'width'=>101.6,        'height'=>25.4,        'font-size'=>8),
        '5162' => array('paper-size'=>'letter',    'metric'=>'mm',    'marginLeft'=>0.97,        'marginTop'=>20.224,    'NX'=>2,    'NY'=>7,    'SpaceX'=>4.762,    'SpaceY'=>0,    'width'=>100.807,    'height'=>35.72,    'font-size'=>8),
        '5163' => array('paper-size'=>'letter',    'metric'=>'mm',    'marginLeft'=>1.762,    'marginTop'=>10.7,         'NX'=>2,    'NY'=>5,    'SpaceX'=>3.175,    'SpaceY'=>0,    'width'=>101.6,        'height'=>50.8,        'font-size'=>8),
        '5164' => array('paper-size'=>'letter',    'metric'=>'in',    'marginLeft'=>0.148,    'marginTop'=>0.5,         'NX'=>2,    'NY'=>3,    'SpaceX'=>0.2031,    'SpaceY'=>0,    'width'=>4.0,        'height'=>3.33,        'font-size'=>12),
        '8600' => array('paper-size'=>'letter',    'metric'=>'mm',    'marginLeft'=>7.1,         'marginTop'=>19,         'NX'=>3,     'NY'=>10,     'SpaceX'=>9.5,         'SpaceY'=>3.1,     'width'=>66.6,         'height'=>25.4,        'font-size'=>8),
        'L7163'=> array('paper-size'=>'A4',        'metric'=>'mm',    'marginLeft'=>5,        'marginTop'=>15,         'NX'=>2,    'NY'=>7,    'SpaceX'=>25,        'SpaceY'=>0,    'width'=>99.1,        'height'=>38.1,        'font-size'=>9),
        '3422' => array('paper-size'=>'A4',        'metric'=>'mm',    'marginLeft'=>0,        'marginTop'=>8.5,         'NX'=>3,    'NY'=>8,    'SpaceX'=>0,        'SpaceY'=>0,    'width'=>70,        'height'=>35,        'font-size'=>9)
    );

    // Constructor
    function __construct($format, $unit='mm', $posX=1, $posY=1) {
        if (is_array($format)) {
            // Custom format
            $Tformat = $format;
        } else {
            // Built-in format
            if (!isset($this->_Avery_Labels[$format]))
                $this->Error('Unknown label format: '.$format);
            $Tformat = $this->_Avery_Labels[$format];
        }

        parent::__construct('P', $unit, $Tformat['paper-size']);
        $this->_Metric_Doc = $unit;
        $this->_Set_Format($Tformat);
        $this->SetFont('Arial');
        $this->SetMargins(0,0);
        $this->SetAutoPageBreak(false);
        $this->_COUNTX = $posX-2;
        $this->_COUNTY = $posY-1;
    }

    function _Set_Format($format) {
        $this->_Margin_Left    = $this->_Convert_Metric($format['marginLeft'], $format['metric']);
        $this->_Margin_Top    = $this->_Convert_Metric($format['marginTop'], $format['metric']);
        $this->_X_Space     = $this->_Convert_Metric($format['SpaceX'], $format['metric']);
        $this->_Y_Space     = $this->_Convert_Metric($format['SpaceY'], $format['metric']);
        $this->_X_Number     = $format['NX'];
        $this->_Y_Number     = $format['NY'];
        $this->_Width         = $this->_Convert_Metric($format['width'], $format['metric']);
        $this->_Height         = $this->_Convert_Metric($format['height'], $format['metric']);
        $this->Set_Font_Size($format['font-size']);
        $this->_Padding        = $this->_Convert_Metric(3, 'mm');
    }

    // convert units (in to mm, mm to in)
    // $src must be 'in' or 'mm'
    function _Convert_Metric($value, $src) {
        $dest = $this->_Metric_Doc;
        if ($src != $dest) {
            $a['in'] = 39.37008;
            $a['mm'] = 1000;
            return $value * $a[$dest] / $a[$src];
        } else {
            return $value;
        }
    }

    // Give the line height for a given font size
    function _Get_Height_Chars($pt) {
        $a = array(6=>2, 7=>2.5, 8=>3, 9=>4, 10=>5, 11=>6, 12=>7, 13=>8, 14=>9, 15=>10);
        if (!isset($a[$pt]))
            $this->Error('Invalid font size: '.$pt);
        return $this->_Convert_Metric($a[$pt], 'mm');
    }

    // Set the character size
    // This changes the line height too
    function Set_Font_Size($pt) {
        $this->_Line_Height = $this->_Get_Height_Chars($pt);
        $this->SetFontSize($pt);
    }

    // Print a label
    function Add_Label($text) {
        $this->_COUNTX++;
        if ($this->_COUNTX == $this->_X_Number) {
            // Row full, we start a new one
            $this->_COUNTX=0;
            $this->_COUNTY++;
            if ($this->_COUNTY == $this->_Y_Number) {
                // End of page reached, we start a new one
                $this->_COUNTY=0;
                $this->AddPage();
            }
        }

        $_PosX = $this->_Margin_Left + $this->_COUNTX*($this->_Width+$this->_X_Space) + $this->_Padding;
        $_PosY = $this->_Margin_Top + $this->_COUNTY*($this->_Height+$this->_Y_Space) + $this->_Padding;
        $this->SetXY($_PosX, $_PosY);
        $this->MultiCell($this->_Width - $this->_Padding, $this->_Line_Height, $text, 0, 'L');
    }

    function _putcatalog()
    {
        parent::_putcatalog();
        // Disable the page scaling option in the printing dialog
        $this->_put('/ViewerPreferences <</PrintScaling /None>>');
    }

}
?>
