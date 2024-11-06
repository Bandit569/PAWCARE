# PAWCARE

## Project Structure

- **`public/`**: Contains all files that are publicly accessible via the web.
    - **`js/`**: JavaScript files.
    - **`css/`**: CSS stylesheets.
    - **`images/`**: Image assets !Only those that can be seen by everyone!

- **`src/`**: Contains the source code and the logic of the application.
    - **`controllers/`**: Contains controllers for handling user actions.
    - **`models/`**: Contains classes responsible for interactions with the database.
    - **`views/`**: Contains php files parsed with html or html files to render the UI

- **`config/`**: Contains configuration files (database settings, file paths for navigation...).

## Conventions
- Follow basic PSR coding standards for PHP.
- Files MUST use only <?php and <?= tags.
- Files MUST use only UTF-8 without BOM for PHP code.
- Files SHOULD either declare symbols (classes, functions, constants, etc.) or cause side-effects (e.g. generate output, change .ini settings, etc.) but SHOULD NOT do both.
- Namespaces and classes MUST follow an "autoloading" PSR: [PSR-0, PSR-4].
- Class names MUST be declared in StudlyCaps.
- Class constants MUST be declared in all upper case with underscore separators.
- Method names MUST be declared in camelCase.

## MAIN BRANCH USE
All push requests to the main branch have to be reviewed and validated. You can create another branch for tests.