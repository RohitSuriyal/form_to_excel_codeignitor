<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	public function index()
	{
		$this->load->view('welcome_message');
	}
	public function view()
	{
		$this->load->view("output");
	}
	public function __construct()
	{
		parent::__construct();

		// Load the Google API Client Library
		require_once FCPATH . 'vendor/autoload.php';
	}

	public function submit()
	{
		// Load Google Client
		$client = new \Google_Client();
		$client->setApplicationName('Google Sheets API with CodeIgniter');
		$client->setScopes([\Google_Service_Sheets::SPREADSHEETS]);
		$client->setAuthConfig(APPPATH . 'google-sheets-credentials.json');
		$client->setAccessType('offline');

		$service = new \Google_Service_Sheets($client);
		$spreadsheetId = '1nlNZDeFWzt0f1dXpUK_xP4JlujUTs6sdpCy26HPJrhU'; // Replace with your actual spreadsheet ID
		$range = 'Sheet1!A1'; // Replace with your desired range

		// Get form data
		$name = $this->input->post('name');
		$email = $this->input->post('email');

		// Prepare data for Google Sheets
		$formData = [
			[$name, $email] // Add more fields as necessary
		];

		$body = new \Google_Service_Sheets_ValueRange([
			'values' => $formData
		]);


		$params = [
			'valueInputOption' => 'RAW'
		];


		// Append data to Google Sheets

		$result = $service->spreadsheets_values->append($spreadsheetId, $range, $body, $params);
	}
}
