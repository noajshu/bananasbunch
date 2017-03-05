# bananasbunch
Bananas wordpress plugin for scheduling &amp; reminders

# Installation
- Open wordpress admin console. Click Plugins -> Add New.
- search for "amr shortcode any widget" and click "Install Now"

- Click Plugins -> Add New.
- search for "WP Twilio Core" and click "Install Now"

- Click Plugins -> Installed Plugins and make sure WP Twilio Core and AMR Shortcode Any Widget are both active (click Activate if not)

- Click Settings -> Twilio
- Enter your Twilio Account SID, Twilio Auth Token (you can get this info here: https://www.twilio.com/console/account/settings)
- Enter your Twilio phone number (you can get that here: https://www.twilio.com/console/phone-numbers/incoming)
- Click Save Changes

- Go back to plugins page and click Add New / Upload Plugin
- Click Choose File and upload the BananaNotifyWidget.zip provided
- It should say "plugin installed successfully" --> now click "Activate Plugin"

- Click Appearance -> Widgets
- Drag BananaNotifyWidget_bananas into the Widgets for Shortcodes bar on the right side of the screen
- Click Save

- Click Pages -> click on the page you want to edit / create a new page
- Activate Text edit mode by clicking the "Text" tab in the upper right of the editor
- Insert the widget by entering this into your page: [do_widget "BananaNotifyWidget_bananas"]
- Click Update on the right side
- Click on the permalink to view the page (including the widget!)
