<?php 
$vowels = array("a", "e", "i", "o", "u");
$clusters = array("bl", "br", "ch", "cl", "cr", "dr", "fl", "fr", "gl", "gr", "pl", 
                  "pr", "sc", "sh", "sk", "sl", "sm", "sn", "sp", "st", "sw", "th", 
                  "tr", "tw", "wh", "wr", "sch", "scr", "shr", "sph", "spl", "spr", 
                  "squ", "str", "thr");
/**
* Takes a given word and translates it into pig latin.
* 
* @param $word
* @return the word in pig latin
*/
function translate($word) {
    // Case 1 - Word starts with vowel
    if (is_vowel($word[0]))
        return $word."-way ";
    else if (is_cluster($word)) {
        $cluster = find_cluster($word);
        // Case 2 - Word starts with 2-letter cluster
        if ($cluster[0] == 2)
            return substr($word, 2) . "-" . $cluster[1] . "ay ";
        // Case 3 - Word starts with 3-letter cluster
        else
            return substr($word, 3) . "-" . $cluster[1] . "ay ";
    }
    // Case 4 - Word starts with consonant
    else 
        return substr($word, 1) . "-" . $word[0] . "ay ";
}

/**
* Determines if a character is a vowel.
*
* @param $character
* @return true if vowel, false otherwise
*/
function is_vowel($character) {
    global $vowels;
    $character = strtolower($character);
    if (in_array($character,$vowels))
        return true;
    else 
        return false; 
}

/**
* Determines if a word starts with a consonant cluster.
*
* @param $word
* @return true if starts with cluster, false otherwise
*/
function is_cluster($word) {
    global $clusters;
    $word = strtolower($word);
    if (in_array(substr($word, 0, 2), $clusters) || in_array(substr($word, 0, 3), $clusters)) 
        return true;
    else 
        return false;
}

/**
* Finds the consonant cluster and returns the number of letters in that 
* cluster along with the cluster itself both in an array.
*
* @param $word
* @return $c array with number of letters in cluster and the cluster
*/
function find_cluster($word) {
    global $clusters;
    if (in_array(substr($word, 0, 3), $clusters)) {
        $c = array(3, substr($word, 0, 3));
        return $c;
    }
    else if (in_array(substr($word, 0, 2), $clusters)) {
        $c = array(2, substr($word, 0, 2));
        return $c;
    }
}
?>
<html>
<head>
    <title>Pig Latin</title>
    <link href="pig.css" rel=stylesheet>
</head>  
<body bgcolor = MistyRose>
<center><br><br><br>
    <h3>Okay-way! Here it is:</h3>
    <center><img src="pig.png" width=300/></center>
    <h2> You said, "
        <?php 
            $message = $_POST['message'];
            echo $message . ' ."';
        ?> 
    </h2>
    <h2> I say, " 
    <?php 
        if(isset($_POST['translate']) && $_POST['translate'] == "Y") {
            $message = $_POST['message'];
            $words = explode(" ", $message);
            $total_words = count($words);
            for ($word = 0; $word < $total_words; $word++) {
                $translation = translate($words[$word]);
                echo $translation;
            }
        echo '."';
        }
        else	
    	   echo 'Forget it. "';
    ?>
    </h2>
</center>
</body>
</html>