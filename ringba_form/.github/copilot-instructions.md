# Ringba Lead Form - AI Assistant Instructions

## Project Overview
This is a PHP-based lead capture form integrated with Ringba's API system. The application collects lead information, stores it in a MySQL database, and forwards it to Ringba's API endpoint.

## Architecture & Data Flow
1. Frontend (`index.php`, `main.js`)
   - Modern responsive form UI with floating labels
   - Client-side validation for required fields and ZIP code format
   - LeadID integration for lead tracking
   - AJAX-based form submission with modal response display

2. Backend (`process.php`, `db.php`)
   - Two-step data processing:
     1. Store in local MySQL database
     2. Forward to Ringba API
   - Returns combined response with database and API results

## Key Integration Points

### 1. LeadID Integration
```javascript
// See index.php for implementation
// LeadID token is captured via callback and stored in hidden form field
function myCallbackFunction(token) {
    document.getElementById("leadid_token").setAttribute('value', token);
}
```

### 2. Ringba API
```php
// API endpoint format (see process.php)
$apiUrl = "https://rtb.ringba.com/v1/production/[campaignId].json";
// Required parameters: CID, CallerID
// Optional: ZipCode, State, leadid_token
```

## Database Configuration
- Database: `ringba_db`
- Table: `ringba_leads`
- Default XAMPP credentials:
  - Host: localhost
  - User: root
  - Password: (empty)

## Development Workflow
1. Local Setup:
   - Requires XAMPP with PHP and MySQL
   - Place project in `htdocs` directory
   - Create `ringba_db` database
   - Access via `http://localhost/Api form/ringba_form/`

2. Form Field Validation:
   - CallerID: Required
   - ZipCode: Optional, must be 5 digits if provided
   - State: Optional
   - CID: Optional

## Important Patterns

### Error Handling
- Client-side: Form validation before submission
- Server-side: Combined validation and API error reporting
- All responses use consistent JSON structure:
```json
{
    "status": "success|error",
    "database_saved": {...},
    "api_response": {...},
    "curl_error": "..."
}
```

### CSS Conventions
- Modern gradient background
- Floating label animation on focus/filled state
- Consistent color scheme using CSS variables
- Responsive design with flex layout

## Project Structure
```
ringba_form/
├── .github/
│   └── copilot-instructions.md
├── css/
│   └── style.css        # Global styles
├── js/
│   └── main.js          # Form handling & AJAX
├── db.php              # Database connection
├── index.php           # Main form UI
└── process.php         # API & data processing
```

## Common Tasks
1. Adding new form fields:
   - Add input to `index.php`
   - Update validation in `main.js` and `process.php`
   - Add column to `ringba_leads` table
   - Update API parameters in `process.php`

2. Modifying API integration:
   - Update `$apiUrl` in `process.php`
   - Adjust parameter mapping in `$params` array