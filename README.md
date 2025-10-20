# select-co/module-email-sender

Lightweight Magento 2 helper module that provides a consistent way to compose and send transactional emails, including support for CC/BCC and file attachments.

It wraps Magento's TransportBuilder with a tiny API consisting of Email and Attachment value objects and a Sender service. This makes your application code simpler and keeps it transport-agnostic. If you also use SelectCo Mailgun, delivery will be handled by that module transparently.

## Features
- Simple Email interface for template, recipients, sender, vars, and options
- Optional CC and BCC recipients
- Attachment support via a custom TransportBuilder extension
- Works with Magento's native transport or third-party transports (e.g., SelectCo Mailgun)

## Requirements
- Magento 2 (tested with 2.3.5)
- PHP compatible with your Magento version
- Composer dependencies (handled via this module):
  - select-co/module-core 1.0.*

## Installation
You can install this module either via Composer or by placing it in app/code.

### Composer (preferred)
1. Require the package:
   - `composer require select-co/module-email-sender`
2. Enable and set up the module:
   - `bin/magento module:enable SelectCo_EmailSender`
   - `bin/magento setup:upgrade`
   - In production mode: `bin/magento setup:di:compile` and `bin/magento setup:static-content:deploy -f`

### Manual installation (app/code)
1. Copy this directory to `app/code/SelectCo/EmailSender`.
2. Run:
   - `bin/magento module:enable SelectCo_EmailSender`
   - `bin/magento setup:upgrade`
   - In production mode: `bin/magento setup:di:compile` and `bin/magento setup:static-content:deploy -f`

## How it works
- Value objects:
  - Email (SelectCo\EmailSender\Model\Email\Email): holds template identifier, vars, options, from, to, cc, bcc, and attachments
  - Attachment (SelectCo\EmailSender\Model\Attachment\Attachment): holds contents, filename, and MIME type
- TransportBuilder extension:
  - SelectCo\EmailSender\Model\Mail\Template\TransportBuilder extends Magento's TransportBuilder to add attachments to the MIME message
- Sender service:
  - SelectCo\EmailSender\Model\Sender composes the Magento transport from your Email and calls sendMessage()

If SelectCo Mailgun is enabled in your system, it will intercept Magento's transport and deliver via the Mailgun API; this module does not need to change.

## Usage
Inject the Sender service where you need to send an email and construct an Email object.

Example (PHP):
```
public function __construct(\SelectCo\EmailSender\Model\Sender $sender)
{
    $this->sender = $sender;
}

$email = new \SelectCo\EmailSender\Model\Email\Email();
$email->setTemplateIdentifier('your_email_template_id');
$email->setTemplateVars([
    'var1' => 'value',
]);
$email->setTemplateOptions([
    'area'  => \Magento\Framework\App\Area::AREA_FRONTEND, // or AREA_ADMINHTML
    'store' => \Magento\Store\Model\Store::DEFAULT_STORE_ID,
]);
$email->setFromByScope(['name' => 'Store Name', 'email' => 'no-reply@example.com']);
$email->setTo(['john.doe@example.com']);
$email->setCc(['copy@example.com']);       // optional
$email->setBcc(['hidden@example.com']);    // optional

// Optional attachment
$attachment = new \SelectCo\EmailSender\Model\Attachment\Attachment();
$attachment->setFileName('invoice.pdf');
$attachment->setFileType('application/pdf');
$attachment->setContents($pdfBinaryContent); // pass raw binary/string content
$email->setAttachments([$attachment]);

// Send it
$this->sender->send($email);
```
Notes:
- getTo(), getCc(), and getBcc() accept either a string email or an array of emails.
- setFromByScope() accepts a sender array ['name' => ..., 'email' => ...] or a configured identity code, consistent with Magento's TransportBuilder.
- When attachments are added, they are encoded and attached via Laminas MIME under the hood.

## Configuration
This module has no admin configuration. Ensure your email templates exist and the template identifier you use is available in the selected area.

## Troubleshooting
- Ensure the template identifier exists in the specified area (frontend or adminhtml)
- Verify From/To addresses are valid
- If using a transport module (e.g., SelectCo Mailgun), confirm that module is enabled and configured
- Check Magento logs for any MailException/LocalizedException stack traces

## License
MIT. See LICENSE.

## Support
If you have a feature request or spotted a bug or a technical problem, create a GitHub issue.