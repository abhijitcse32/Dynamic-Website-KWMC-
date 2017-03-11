<?php	
	if(isset($_GET['Page']))
	{
		$Page=trim($_GET['Page']);
		if($Page=='About')
		{
			include('gui/about_us.php');
		}
		elseif($Page=='Objective')
		{
			include('gui/objective.php');
		}
		
		elseif($Page=='Faculty')
		{
			include('gui/faculty.php');
		}
		
		elseif($Page=='Library')
		{
			include('gui/library.php');
		}
		
		elseif($Page=='Accommodation')
		{
			include('gui/accommodation.php');
		}
		
		elseif($Page=='Admission')
		{
			include('gui/admission.php');
		}
		
		elseif($Page=='Contact')
		{
			include('gui/contact.php');
		}
		
		elseif($Page=='Quality')
		{
			include('gui/quality.php');
		}
		elseif($Page=='RPS')
		{
			include('gui/rp.php');
		}
		elseif($Page=='NSC')
		{
			include('gui/nursing.php');
		}
		
		elseif($Page=='Result')
		{
			include('gui/mbbsres.php');
		}
		
		elseif($Page=='BDSResult')
		{
			include('gui/bdsres.php');
		}
		
		elseif($Page=='Waiting')
		{
			include('gui/wait.php');
		}

	}
	else
	{
		include('gui/mainhome.php');
	}
?>