<?php
class ContactPage extends Page {
	private static $db = array(
		'Mailto' => 'Varchar(100)',
		'SubmitText' => 'Text',
		'ErrorText' => 'Text',
	);

	public function getCMSFields(){
		$fields = parent::getCMSFields();
		$fields->addFieldToTab("Root.Submission", new TextField('Mailto', 'Email submissions to'));
		$fields->addFieldToTab("Root.Submission", new TextareaField('SubmitText', 'Text on Submission'));
		$fields->addFieldToTab("Root.Submission", new TextareaField('ErrorText', 'Text on Error'));
		return $fields;
	}
}

class ContactPage_Controller extends Page_Controller {
	
	private static $allowed_actions = array (
	);

	public function init() {
		parent::init();
	}

	public function ContactForm(){

		$fields = new FieldList(
			EmailField::create("Email", "Your email")
				->addExtraClass("form-control")
				->setAttribute('placeholder', _t('ContactPage.EMAIL','Your email'))
				->setAttribute('data-validation', 'email')
				->setAttribute('tabindex', '1'),
			TextField::create("Subject", "Subject")
				->addExtraClass("form-control")
				->setAttribute('placeholder', _t('ContactPage.SUBJECT','Subject'))
				->setAttribute('data-validation', 'required')
				->setAttribute('tabindex', '2'),
			TextareaField::create("Message", "Your message")
				->addExtraClass("form-control")
				->setAttribute('placeholder', _t('ContactPage.MESSAGE','Your message'))
				->setAttribute('data-validation', 'required')
				->setAttribute('data-validation-length', 'min10')
				->setAttribute('tabindex', '3')
		);

		$actions = new FieldList(FormAction::create("SendContactForm")->setTitle(_t('ContactPage.SUBMIT','submit'))->addExtraClass("btn btn-block")->setAttribute('tabindex', '4'));

		$validator = new RequiredFields('Email', 'Subject', 'Message');

		return new Form($this, 'ContactForm', $fields, $actions, $validator);
	}

	public function SendContactForm(array $data, Form $form) {

		$email = $data['Email'];

		if(Email::validEmailAddress($email)){

			$email = new Email();
			$email->setTo($this->Mailto);
			$email->setFrom($data['Email']);
			$email->replyTo($data['Email']);
			$email->setSubject(_t('ContactPage.FORM_SUBJECT', "Contact Message from {email}", array('email' => $data["Email"])));
			$email->setBody(_t('ContactPage.FORM_EMAIL', 			"<p><strong>Email:</strong> {email}</p>", 		array('email' => $data["Email"]))
						  . _t('ContactPage.FORM_MESSAGE_SUBJECT', 	"<p><strong>Subject:</strong> {subject}</p>", 	array('subject' => $data["Subject"]))
						  . _t('ContactPage.FORM_MESSAGE', 			"<p><strong>Message:</strong> {message}</p>", 	array('message' => $data["Message"]))
				);

			$email->send();
	
			return $this->redirect($this->Link() . _t('ContactPage.FORM_FINISHED','finished'));

		}else{
			return $this->redirect($this->Link() . 'error');
		}
	}

	public function error(){
		return $this->customise(array(
			'Content' => "<h4>{$this->ErrorText}</h4>",
			'ContactForm' => '',
		));
	}

	public function ket_thuc(){
		return $this->customise(array(
			'Content' => "<h4>{$this->SubmitText}</h4>",
			'ContactForm' => '',
		));
	}
	public function termine(){
		return $this->customise(array(
			'Content' => "<h4>{$this->SubmitText}</h4>",
			'ContactForm' => '',
		));
	}

	public function finished(){
		return $this->customise(array(
			'Content' => "<h4>{$this->SubmitText}</h4>",
			'ContactForm' => '',
		));
	}
}