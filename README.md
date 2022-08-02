# Axelerant Drupal Camp Test

This is a DrupalCamp website sparingly built for the purposes of hiring tests at Axelerant.

## Table of Contents

[[_TOC_]]

## About

We are very happy you are considering to join Axelerant. We want to find a mutual fit to ensure you enjoy your time at Axelerant along with the rest of the team. To that end, we have designed a test that would mirror your day-to-day responsibilities while requiring minimum time commitment on your part. The test is designed to match your applied level and it covers site building and custom development tasks. You are encouraged to complete as many tasks as you can. More details on what we check may be found in the next section.

**IMPORTANT**: This code interview test is designed for candidates applying to the **Drupal Developer II** role. If you have not applied to that role, please let the recruiting team know so that we can send you the correct test for your application.

We have created issues for each of the tasks assigned to you in your project. You should mention the issue number in your commit messages to [crosslink issues and commits](https://docs.gitlab.com/ee/user/project/issues/crosslinking_issues.html). You are also encouraged to create branches and [merge requests](https://docs.gitlab.com/ee/user/project/merge_requests/) for each of the task but this is optional.

### What do we look for?

You are expected to deliver production-grade code adhering to various standards. Axelerant's code quality checker is included in the project which should tell you if some of the basic requirements of your code are met when you commit. We look for adherence to software engineering best practices and Drupal coding standards. Some of the things we will check are as follows:

* Drupal code style
* Drupal Composer workflow
* Configuration exported as per Drupal configuration management practices
* Readable and efficient code in custom modules
* Clear naming convention and proper grammar in descriptions, code, and configuration
* Clear and meaningful commit messages with links to issue numbers

This list is not exhaustive and should serve as an indicator of the quality standards we expect when interviewing and working at Axelerant.

## Your test

We have assigned multiple tasks to you depending on the level you have applied. These tasks are created as issues which you may find in the project we have created for you.First, set up your development environment as instructed in this file and then pick any issue in any logical order for your problem statements.

We estimate that setting up your local development environment would take about **1-5 minutes** if you already have Lando and Docker installed on your system. If you do not have Docker and Lando installed, or you need to upgrade it, the setup might take up to about **30 minutes**. Further, we target the test to be completed in a reasonable timeframe of about **4 hours** for a developer at that level at which they are applying.

**IMPORTANT**: These time estimates are just that–an estimate. You are free to take **up to 2 weeks** to complete this test at your convenience.

### Tools & Prerequisites

The following tools are required for setting up the site. Ensure you are using the latest version or at least the minimum version mentioned below. Also, ensure that you have added [your SSH key in your GitLab account settings](https://docs.gitlab.com/ee/ssh/#adding-an-ssh-key-to-your-gitlab-account).

* [Composer](https://getcomposer.org/download/)
* [Docker](https://docs.docker.com/install/)
* [Lando](https://docs.lando.dev/basics/installation.html) or [DDEV](https://ddev.readthedocs.io/en/stable/#installation)
* [Git](https://git-scm.com/book/en/v2/Getting-Started-Installing-Git)

*Additional Note*: Docker and Lando are highly recommended but optional. See the instructions on Alternative setup below for more details.

*Important Note*: Ensure you have sufficient RAM (ideally 16 GB, minimum 8 GB).

### Local environment setup

Once you have all the tools installed, proceed to clone the repository and run lando to start.

```bash
$ lando start
```

Once Lando has been setup successfully, it will display the links in the terminal. Next run the following to fetch all dependencies.

```bash
$ lando composer install
```

Once the application has successfully started, run the configuration import and database update commands.

```bash
# Import drupal configuration
$ lando drush cim
```

```bash
# Update database
$ lando drush updb
```

### Alternative setup

You are free to use an alternative local environment setup. Lando configuration is provided to help you complete the test faster but if you are more comfortable with an alternative such as DDEV, Docksal, or just plain-old LAMP setup, go ahead and set it up. Just know that we won't be able to support you if you run into trouble in those cases. Also, note that the commands mentioned above would have to be adjusted accordingly.

If you opt to pick another setup, you will also not get the database by default. Feel free to contact us to get a starter database that you can import to get started.

#### DDEV

To help you get started, we also have included DDEV settings. The support is limited compared to Lando but you should not face any major problems. Replace all commands above to the DDEV equivalent. For example, `ddev composer install`, `ddev drush updb` and so on. As mentioned before, you will have to still import the database from the SQL file we send you.

### Post Installation

Generate a one time login link and reset the password through it.

```bash
$ lando drush uli
```

Clear the cache using drush

```bash
$ lando drush cr
```

You can access the site at: [https://axltest.lndo.site/](https://axltest.lndo.site/). If you see SSL errors, you can either choose to ignore it or [add Lando's CA to your system](https://docs.lando.dev/config/security.html#trusting-the-ca). You could also alternatively just use the non-https URL at [http://axltest.lndo.site/](http://axltest.lndo.site/).

### Tasks

You should now be ready to work on your test. Check the issues page on this project to see the issues that have been assigned to you.

### Submitting changes

Before committing your changes, make sure you are working on the latest codebase by fetching or pulling to make sure you have all the work.

```bash
$ git checkout main
$ git pull origin main
```

To submit code:

1. Create a branch specific to the feature.

    ```bash
    $ git checkout -b <branch-name>
    ```

2. Make the required changes and commit

    ```bash
    $ git commit -m "commit-message"
    ```

3. Push the changes

    ```bash
    $ git push origin <branch-name>
    ```

## FAQs

1. **Why do I get permission errors when running `lando start`?**

   Make sure that your have set the right group permission for Docker to run properly. Please take a look at the [Additional Setup Section](https://docs.lando.dev/basics/installation.html#additional-setup) when installing LANDO.

2. **(Ubuntu) If Docker has installed successfully but still throwing error `Unable to locate package docker-ce on a 64bit ubuntu`.**

   Make sure that `docker-ce` package is available on the official docker.for that you need to add [docker add-apt
   -repository](https://unix.stackexchange.com/questions/363048/unable-to-locate-package-docker-ce-on-a-64bit-ubuntu).

## Resources

1. [Drupal 8 development with LANDO](https://docs.lando.dev/config/drupal8.html#getting-started)
2. [Dockerization for Beginners](https://docker-curriculum.com/)
