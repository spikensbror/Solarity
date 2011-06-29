<?php

function recurse_copy($src,$dst) { 
    $dir = opendir($src); 
    @mkdir($dst); 
    while(false !== ( $file = readdir($dir)) ) { 
        if (( $file != '.' ) && ( $file != '..' )) { 
            if ( is_dir($src . '/' . $file) ) { 
                recurse_copy($src . '/' . $file,$dst . '/' . $file); 
            } 
            else { 
                copy($src . '/' . $file,$dst . '/' . $file); 
            } 
        } 
    } 
    closedir($dir); 
} 

?>

<html>
	<head>
		<title>Solarity Application Initialization</title>
	</head>
	
	<body>
		<center>
			<?php
			if(!file_exists('index.php') && isset($_POST['submit']) && isset($_POST['index_controller']) && isset($_POST['app_url']))
			{
				$root = $_POST['solarity_root'];
				if(substr($root, strlen($root) - 1) != '/')
				{
					$root .= '/';
				}
				
				if(!is_dir($root))
				{
					?>
					<h2>Error</h2>
					<p>
						The path you specified does not exist.
					</p>
					<?php
				}
				elseif(!file_exists($root . 'solarity.php'))
				{
					?>
					<h2>Error</h2>
					<p>
						The path you specified does not contain a valid solarity install.
					</p>
					<?php
				}
				else
				{
					include_once($root . 'solarity.php');
					Solarity::get_instance()->initialize(__FILE__, $_POST['index_controller'], $_POST['app_url']);
					recurse_copy($root . 'application/', dirname(__FILE__) . '/');
					mkdir('models/');
					mkdir('public/');
					rename('htaccess', '.htaccess');
					$index = file_get_contents('index.php');
					$index = str_replace('{SOLARITY_ROOT}', SOLARITY_ROOT, $index);
					$index = str_replace('{INDEX_CONTROLLER}', INDEX, $index);
					$index = str_replace('{APP_URL}', APP_URL, $index);
					file_put_contents('index.php', $index);
					?>
					<h2>Success</h2>
					<p>
						The initialization was successful!<br/>
						Now go code!
					</p>
					<?php
				}
			}
			elseif(!file_exists('index.php'))
			{
			?>
			<h2>Initialization</h2>
			<form method="post">
				<p>
					Path to solarity(can be relative):<br/>
					<input type="text" name="solarity_root"/>
				</p>
				
				<p>
					Index controller:<br/>
					<input type="text" name="index_controller"/>
				</p>
				
				<p>
					Application URL(http://your.url/):<br/>
					<input type="text" name="app_url"/>
				</p>
				
				<input type="submit" name="submit" value="Initialize"/>
			</form>
			<?php
			}
			else
			{
			?>
			<h2>Error</h2>
			<p>
				Index file already present.
			</p>
			<?php
			}
			?>
		</center>
	</body>
</html>