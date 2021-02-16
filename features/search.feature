Feature: Search repositories

    As a GitHub user I would like to search for a repository in order to find what I need

    Scenario: Behat based reposistories
        Given I am a anonymous user
        When I search for 'behat'
        Then I get a result