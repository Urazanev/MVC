<?php include ROOT . '/views/layouts/header.php'; ?>

<!-- MAIN -->
		<div id="main">
			<!-- wrapper-main -->
			<div class="wrapper">
			
						
				<!-- search -->
				<div class="top-search">
					<form  method="get" id="searchform" action="#">
						<div>
							<input type="text" value="Search..." name="s" id="s" onfocus="defaultInput(this,'Search...')" onblur="clearInput(this,'Search...')" />
							<input type="submit" id="searchsubmit" value=" " />
						</div>
					</form>
				</div>
				<!-- ENDS search -->
			<!-- form -->
                        <script type="text/javascript" src="/template/js/form-validation.js"></script>
					<form id="contactForm" action="#" method="post">
						<fieldset>
							<div>
								<input name="name"  id="name" type="text" class="form-poshytip" title="Ваше имя" value="Name" onfocus="defaultInput(this,'Name')" onblur="clearInput(this,'Name')" />
							</div>
							<div>
								<input name="email"  id="email" type="text" class="form-poshytip" title="Адрес электронной почты" value="Email" onfocus="defaultInput(this,'Email')" onblur="clearInput(this,'Email')"  />
							</div>
							<div>
								<textarea  name="comments"  id="comments" rows="5" cols="20" class="form-poshytip" title="Сообщение" onfocus="defaultInput(this,'How can i help you?')" onblur="clearInput(this,'How can i help you?')" >Сообщение</textarea>
							</div>
							
							<!-- send mail configuration -->
							<input type="hidden" value="" name="to" id="to" />
							<input type="hidden" value="" name="from" id="from" />
							<input type="hidden" value="From contact form" name="subject" id="subject" />
							<input type="hidden" value="send-mail.php" name="sendMailUrl" id="sendMailUrl" />
							<!-- ENDS send mail configuration -->
							
							<div><input type="button" value="Отправить" name="submit" id="submit" /></div>
						</fieldset>
					</form>
					<p id="success" class="success">Ваше сообщение было отправлено.</p>
					<!-- ENDS form -->
				
				
			<div class="clear"></div>
			</div>
			<!-- ENDS wrapper-main -->
		</div>
		<!-- ENDS MAIN -->


<?php include ROOT . '/views/layouts/footer.php'; ?>