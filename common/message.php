<?php

if(isset($_REQUEST['msg']) and $_REQUEST['msg']=="un"){

    echo	'<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> User name is mandatory field!</div>';

}elseif(isset($_REQUEST['msg']) and $_REQUEST['msg']=="ue"){

    echo	'<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> User email is mandatory field!</div>';

}elseif(isset($_REQUEST['msg']) and $_REQUEST['msg']=="up"){

    echo	'<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> User phone is mandatory field!</div>';

}elseif(isset($_REQUEST['msg']) and $_REQUEST['msg']=="ras"){

    echo	'<div class="alert alert-success"><i class="fa fa-thumbs-up"></i> Record added successfully!</div>';

}elseif(isset($_REQUEST['msg']) and $_REQUEST['msg']=="rna"){

    echo	'<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> Record not added <strong>Please try again!</strong></div>';

}elseif(isset($_REQUEST['msg']) and $_REQUEST['msg']=="dsd"){

    echo	'<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> Please delete a user and then try again <strong>We set limit for security reasons!</strong></div>';

}elseif(isset($_REQUEST['msg']) and $_REQUEST['msg']=="matchprod"){

    echo	'<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> This category is already available, please add new produut category !</div>';

}elseif(isset($_REQUEST['msg']) and $_REQUEST['msg']=="matchbrand"){

    echo	'<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> This brand is already available, please add new Product brand !</div>';

}elseif(isset($_REQUEST['msg']) and $_REQUEST['msg']=="matchvendor"){

    echo	'<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> This vendor is already available, please add new vendor details !</div>';

}
elseif(isset($_REQUEST['msg']) and $_REQUEST['msg']=="upok"){

    echo	'<div class="alert alert-success"><i class="fa fa-exclamation-triangle"></i> Invoice details modified successfully !</div>';

}elseif(isset($_REQUEST['msg']) and $_REQUEST['msg']=="upnotok"){

    echo	'<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i>  Invoice details not modified, Please try again !</div>';

}elseif(isset($_REQUEST['msg']) and $_REQUEST['msg']=="matchinvoice"){

    echo	'<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i>  This Invoice details already entered, Please add new invoice details !</div>';

}elseif(isset($_REQUEST['msg']) and $_REQUEST['msg']=="saveok"){

    echo	'<div class="alert alert-success"><i class="fa fa-exclamation-triangle"></i> Invoice details saved successfully !</div>';

}elseif(isset($_REQUEST['msg']) and $_REQUEST['msg']=="savenotok"){

    echo	'<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i>  Invoice details not saved, Please try again !</div>';

}elseif(isset($_REQUEST['msg']) and $_REQUEST['msg']=="rosuccess"){

    echo	'<div id="rosuccess" class="alert alert-success"><i class="fa fa-exclamation-triangle"></i> This Regional Office details save success fully, please add new regional bank details !</div>';

}
elseif(isset($_REQUEST['msg']) and $_REQUEST['msg']=="rofail"){

    echo	'<div id="rosaved" class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> This Regional Office is saved available, please add new vendor details !</div>';

}
elseif(isset($_REQUEST['msg']) and $_REQUEST['msg']=="romatch"){

    echo	'<div id="rofail" class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> matchThis Regional Office is saved available, please add new vendor details !</div>';

}


?>
