# Lemon HRM

Lemon HRM is a fork of the Orange HRM open source human resource management tool. You can view the original Orange HRM Readme below. Lemon HRM adds the following features.

## Automated recruitment notifications

When a candidate applies for a job vacancy, Lemon HRM sends e-mail notifications:
1. to candidate, confirming receipt of their application.
2. to the hiring manager, letting them know there's a nice application.

The templates for these e-mails can be found in `symfony/plugins/orangehrmRecruitmentPlugin/modules/recruitmentApply/templates/mail/`.

## Cover letter and notes field for job candidates

Lemon HRM adds a "Cover Letter" field to job applications and candidate views. It also adds a "Notes" field to internal-only candidate views.

## Database changes

Some database changes are required for the functionality above. The have been added to the update script in `upgrader/apps/upgrader/lib/schemaIncrementTasks/SchemaIncrementTask55.php`.

## Legal notice

By contributing code or other works of authorship to this project
("Your Contributions"), you grant to the Electronic Frontier Foundation
(EFF) a perpetual, worldwide, non-exclusive, no-charge, royalty-free,
irrevocable license to reproduce, prepare derivative works of, publicly
display, publicly perform, sublicense, and distribute Your Contributions
and such derivative works under the terms of any free software or open
source license or licenses, such license or licenses to be selected by
EFF at its sole discretion, and to authorize others to perform the same
acts under the terms of any such license or licenses.

By contributing code or other works of authorship to this project, you 
represent that you have the legal right and ability to grant this
license.

Except for the license granted herein to EFF and recipients of
software distributed by EFF, You reserve all right, title,
and interest in and to Your Contributions.

If you do not agree to these terms, please do not commit any material
to this repository.

--- Original OHRM README ---

OrangeHRM is a comprehensive Human Resource Management (HRM) System that captures 
all the essential functionalities required for any enterprise. 
Copyright (C) 2006 OrangeHRM Inc., http://www.orangehrm.com/

OrangeHRM is free software; you can redistribute it and/or modify it under the terms of
the GNU General Public License as published by the Free Software Foundation; either
version 2 of the License, or (at your option) any later version.

OrangeHRM is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; 
without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. 
See the GNU General Public License for more details.

Installing
----------
1. Install OrangeHRM using the web installer

Deprecated Notes
----------------

The source that you have downloaded(ZIP archive) in which this was enclosed, is of the 
directory structure as follows; ( since release of OrangeHRM version 0.1 we have altered 
the directory structure, for further details please refer to the changelog.txt


|
-dbscript
|	|
|	-- (database script for MySQL)
|
-installer (contains the Web-Installer)
|
-language (contains the Language Packs)
|
-lib
|	|
|	-- common (commonly used objects and methods)
|	-- confs (Configuration files)
|	-- controllers (Primary & Secondary Controllers)
|			CentralController.php (Main Controller)
|			EmpViewController.php (Secondary Controller for PIM Module)
|			MTViewController.php (Secondary Controller for Maintenance Module)
|			RepViewController.php (Secondary Controller for Reports Module)
|			ViewController.php (Secondary Controller for Admin Module)
|
|	-- dao (Data Access Objects)			
|	-- exception (Exception Handlers for Database Exceptions)
|	-- extractor (Data Extractors)
|				|
|				-- eimadmin (Data Extractors for Admin Module)
|				-- hrfunct (Data Extractors for PIM Module)
|				-- maintenance (Data Extractors for Maintenance Module)
|				-- report (Data Extractors for Report Module)
|				
|	-- logs (Log & LogFileWriter)
|	-- Models (Models)
|			|
|			-- eimadmin (Admin Module Objects)
|			-- hrfunct (PIM Module Objects)
|			-- maintenance (Application Maintenance Objects)
|			-- report (Report Module Objects)
|	
-license
|	|
|	-- (The GPL license)
|
-scripts
|	|
|	-- (Javascript files, style sheets required by UI)
|
-templates
|	|
|	-- eimadmin (Admin Module UI templates)
|	-- hrfunct (PIM Module UI templates)
|	-- maintenance (Maintenance Module UI templates)
|	-- report (Report Module UI templates)
|
-themes
	|
	-- (pictures + style sheets)


For further information on how to use the product please refer the Free User Guide 
available on http://orangehrm.com/

In case Installation difficulties there is a seperate Installation Guides also 
available from the same source. 

For Apache/PHP/MySQL Installation issues please refer to the Environment Setup Guide
For OrangeHRM Installation issues please refer to the OrangeHRM Installation Guide
