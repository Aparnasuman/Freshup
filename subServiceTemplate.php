<div class="box-body" id="subCategory">
	<div class="form-group">
		<label for="sel1"><?php if($this->session->userdata('language') == 'en'){ echo 'Category Title'; } else{ echo  'Titre de la catégorie'; } ?></label>
		<select class="form-control" name="subServiceId" id="serviceId">
			<option value=""><?php if($this->session->userdata('language') == 'en'){ echo 'Select Category'; } else{ echo  'Choisir une catégorie'; } ?></option>
			<?php foreach($subServicesDetails as $serviceDetails){?>
				<option value="<?php echo $serviceDetails['id'];?>"><?php if($this->session->userdata('language') == 'en'){ echo $serviceDetails['title'] ; } else{ echo $serviceDetails['frenchTitle'] ; } ?></option>
			<?php } ?>
		</select>
	</div>
</div>