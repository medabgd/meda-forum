<div id="sadrzaj">  
		<div id="autor">
		<div id="naslov">
			<p>
				About me
			</p>
		</div>
		<div id="slika">
			<img src="images/milos.jpg" title="author" alt="milos medic"/>
		</div>
		<div id="ukratko">
			<p>
				Hi, my name is Miloš Medić, I was born on 29th of January in 1995. I graduated from the middle Electrotechnical school “PTT”, for telecommunications engineering. Upon finishing high school I got accepted to “ICT College of Vocational Studies” in Belgrade in 2014,  where I’m currently in the second year of studies. This is my third school project.<br/><br/>
				<b>e-mail:</b><a href="mailto:milos.medic.130.14@ict.edu.rs?subject=Got site&body=Hi Milos, " title="e-mail"> milos.medic.130.14@ict.edu.rs</a><br/><br/>
			</p>
		</div>
			<div class="cisti"></div> 
	</div>  
</div> 
<div id="desno">
	<?php
		//statistika sajta
	$upit1 = "SELECT COUNT(*) as ukupno FROM posts";
	$upit2 = "SELECT COUNT(*) as ukupno FROM users";
	$upit3 = "SELECT COUNT(*) as ukupno FROM comments";
		include("konekcija.php");
		$posts = mysql_query($upit1, $konekcija);
		$users = mysql_query($upit2, $konekcija);
		$comments = mysql_query($upit3, $konekcija);
		mysql_close($konekcija); 
	
	$pom1 = mysql_fetch_assoc($posts);
	$broj_postova = $pom1['ukupno'];
	
	$pom2 = mysql_fetch_assoc($users);
	$broj_usera = $pom2['ukupno'];
	
	$pom3 = mysql_fetch_assoc($comments);
	$broj_komentara = $pom3['ukupno'];

//anketa

	$idpoll = '';
	$question = '';
	$upit = "SELECT * FROM poll WHERE active='1'";
			include("konekcija.php");
			$rezulta3t = mysql_query($upit, $konekcija);  
			mysql_close($konekcija);
		
		while($red = mysql_fetch_array($rezulta3t)){ 
			$idpoll = $red['id_poll'];
			$question .= $red['question'];
		}
	
	 
	$answer = ''; 
	$newvote = '';
	$userip = '';
	$upit34 = "SELECT * FROM poll_answers WHERE id_poll='".$idpoll."' ";
			include("konekcija.php");
			$rezultat14 = mysql_query($upit34, $konekcija);  
			mysql_close($konekcija);
		
		while($red = mysql_fetch_array($rezultat14)){  
			$vote = $red['votes'];
			$idanswer = $red['id_answers'];
			$newvote = $vote + 1;
			$userip = $_SERVER['REMOTE_ADDR'];
			//$newipaddress = $newipaddress."$userip,";
			
			
			if(isset($_REQUEST['rbPoll'])){
				
				$voted = @$_REQUEST['rbPoll']; 
				 
					
				
				$upit38 = "UPDATE poll_answers SET votes = '".$newvote."' WHERE id_answers='".$voted."' ";
				include("konekcija.php");
					$rezultat = mysql_query($upit38, $konekcija); 
					mysql_close($konekcija);
				//, ip_adress='".$userip."'
				$upit399 = "INSERT INTO poll_votes (id_votes, id_answers, ip_adress) VALUES(NULL, '".$idanswer."','".$userip."') ";
				include("konekcija.php");
					$rezultat = mysql_query($upit399, $konekcija); 
					mysql_close($konekcija);
				   
			}
			 
			
			$answer .=  "<div class='radio'><label><input type='radio' name='rbPoll' class='poll' value='".$idanswer."' onchange='javascript:this.form.submit();'/> ".$red['answer']."</label></div>";
		}
	
	 
	echo (
		"<div id='desnocontent'>
			<p>STATISTICS</p>
			<div id='statistika'> 
				<div class='tridela' id='members'>
					<span class='brojevi' id='broj'>$broj_usera</span>
					<span class='spanovi' >MEMBERS</span>
				</div>
				<div class='tridela' id='posts'>
					<span class='brojevi' id='posts'>$broj_postova</span>
					<span class='spanovi'>POSTS</span>
				</div>
				<div class='tridela' id='comments'>
					<span class='brojevi' id='comments'>$broj_komentara</span>
					<span class='spanovi'>COMMENTS</span>
				</div>
			</div>
			
			<p>POLL</p>
			<div id='statistika'> 
			<div id='statistika2'> 
				
			</div>
			</div>
			
			
			 
			
		</div>
		 
		"
	);
	?>
</div>