# Actions

## Features
- Workflow and Designer
- Execute on the command line and in the browser

## Requirements

This plugin requires Craft CMS 5.0.0 or later, and PHP 8.2 or later.

## Installation

You can install this plugin from the Plugin Store or with Composer.

#### From the Plugin Store

Go to the Plugin Store in your project’s Control Panel and search for “Actions”. Then press “Install”.

#### With Composer

Open your terminal and run the following commands:

```bash
# go to the project directory
cd /path/to/my-project.test

# tell Composer to load the plugin
composer require panlatent/craft-actions

# tell Craft to install the plugin
./craft plugin/install actions
```
## Usage

### Concepts

- `Action` is a specific operation or task
- `Trigger` define which external events to respond to.
- `Script` is a sequence of actions without trigger and conditions
- `Workflow` is is a complex script with triggers and conditions
- `Automation` is similar to workflow, but is usually used by developers

#### Workflow vs Automation

- Workflow is [Element]()
- Automation supports [Project Config](), which means it can sync with your project
