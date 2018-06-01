@block @local_fcl_starred_courses
Feature: The starred courses block

  @javascript
  Scenario: Confirming settings defaults
    And I log in as "admin"
    And I am on site homepage
    When I navigate to "Starred courses" node in "Site administration>Plugins>Blocks"
    Then the field "s__local_fcl_starred_courses_display_starred" matches value "1"
    Then the field "s__local_fcl_starred_courses_display_recent" matches value "0"
    Then the field "s__local_fcl_starred_courses_display_toggle" matches value "1"
    Then the field "s__local_fcl_starred_courses_name_length" matches value "0"
    Then the field "s__local_fcl_starred_courses_recent_enrolled_only" matches value "0"
    Then the field "s__local_fcl_starred_courses_exclude_starred_from_recent" matches value "1"
    Then the field "s__local_fcl_starred_courses_recent_limit" matches value "5"

  @javascript
  Scenario: Exclude starred from recent
    Given the following "courses" exist:
      | fullname     | shortname   | numsections |
      | Course One   | courseone   | 15          |
      | Course Two   | coursetwo   | 15          |
      | Course Three | coursethree | 15          |
    Given the following config values are set as admin:
      | name                                              | value |
      | local_fcl_starred_courses_display_starred             | 2     |
      | local_fcl_starred_courses_display_recent              | 2     |
      | local_fcl_starred_courses_display_toggle              | 1     |
      | local_fcl_starred_courses_name_length                 | 0     |
      | local_fcl_starred_courses_recent_enrolled_only        | 0     |
      | local_fcl_starred_courses_exclude_starred_from_recent | 1     |
      | local_fcl_starred_courses_recent_limit                | 0     |

    And I log in as "admin"
    And I am on site homepage
    And I turn editing mode on
    And I add the "Starred courses" block
    And I open the "local_fcl_starred_courses" blocks action menu
    And I follow "Configure Starred Courses block"
    And I select "Display throughout the entire site" from the "bui_contexts" singleselect
    And I press "Save changes"

    And I am on site homepage
    And I follow "Course One"
    And I follow "Star this course"
    And I am on site homepage
    And I follow "Course Two"
    And I follow "Star this course"
    And I am on site homepage
    And I follow "Course Three"
    And I follow "Star this course"

    # There should be no recent courses, so we should not see the title
    Then I should see "Starred Courses" in the ".local_fcl_starred_courses .card-text.content" "css_element"
    Then I should not see "Recent Courses" in the ".local_fcl_starred_courses .card-text.content" "css_element"
    Then I should see "Course One" in the ".local_fcl_starred_courses" "css_element"
    Then I should see "Course Two" in the ".local_fcl_starred_courses" "css_element"
    Then I should see "Course Three" in the ".local_fcl_starred_courses" "css_element"

    Given I am on site homepage
    Given the following config values are set as admin:
      | name                                              | value |
      | local_fcl_starred_courses_exclude_starred_from_recent | 0     |

    # But now we should see the title, because all the courses should show up under recent as well as starred
    And I reload the page
    Then I should see "Starred Courses" in the ".local_fcl_starred_courses .card-text.content" "css_element"
    Then I should see "Recent Courses" in the ".local_fcl_starred_courses .card-text.content" "css_element"
    Then I should see "Course One" in the ".local_fcl_starred_courses" "css_element"
    Then I should see "Course Two" in the ".local_fcl_starred_courses" "css_element"
    Then I should see "Course Three" in the ".local_fcl_starred_courses" "css_element"

    # And if we unstar a course, will it appear under recent?
    Given the following config values are set as admin:
    | name                                              | value |
    | local_fcl_starred_courses_exclude_starred_from_recent | 1     |

    And I reload the page
    Then I should see "Starred Courses" in the ".local_fcl_starred_courses .card-text.content" "css_element"
    Then I should not see "Recent Courses" in the ".local_fcl_starred_courses .card-text.content" "css_element"
    Then I should see "Course One" in the ".local_fcl_starred_courses" "css_element"
    Then I should see "Course Two" in the ".local_fcl_starred_courses" "css_element"
    Then I should see "Course Three" in the ".local_fcl_starred_courses" "css_element"

    And I follow "Course One"
    And I follow "Unstar this course"

    Then I should see "Starred Courses" in the ".local_fcl_starred_courses .card-text.content" "css_element"
    Then I should see "Recent Courses" in the ".local_fcl_starred_courses .card-text.content" "css_element"
    Then I should see "Course One" in the ".local_fcl_starred_courses" "css_element"
    Then I should see "Course Two" in the ".local_fcl_starred_courses" "css_element"
    Then I should see "Course Three" in the ".local_fcl_starred_courses" "css_element"

  @javascript
  Scenario: Starred courses
    Given the following "courses" exist:
      | fullname     | shortname   | numsections |
      | Course One   | courseone   | 15          |
      | Course Two   | coursetwo   | 15          |
      | Course Three | coursethree | 15          |
    Given the following config values are set as admin:
      | name                                       | value |
      | local_fcl_starred_courses_display_starred      | 2     |
      | local_fcl_starred_courses_display_recent       | 0     |
      | local_fcl_starred_courses_display_toggle       | 1     |
      | local_fcl_starred_courses_name_length          | 0     |
      | local_fcl_starred_courses_recent_enrolled_only | 0     |
      | local_fcl_starred_courses_recent_limit         | 0     |

    And I log in as "admin"
    And I am on site homepage
    And I turn editing mode on
    And I add the "Starred courses" block
    And I open the "local_fcl_starred_courses" blocks action menu
    And I follow "Configure Starred Courses block"
    And I select "Display throughout the entire site" from the "bui_contexts" singleselect
    And I press "Save changes"

    And I am on site homepage
    And I follow "Course One"
    And I follow "Star this course"
    And I am on site homepage
    And I follow "Course Two"
    And I follow "Star this course"
    And I am on site homepage
    And I follow "Course Three"
    And I follow "Star this course"

    Then I should see "Course One" in the ".local_fcl_starred_courses" "css_element"
    Then I should see "Course Two" in the ".local_fcl_starred_courses" "css_element"
    Then I should see "Course Three" in the ".local_fcl_starred_courses" "css_element"

    And I am on site homepage
    And I follow "Course Three"
    And I follow "Unstar this course"

    Then I should see "Course One" in the ".local_fcl_starred_courses" "css_element"
    Then I should see "Course Two" in the ".local_fcl_starred_courses" "css_element"
    Then I should not see "Course Three" in the ".local_fcl_starred_courses" "css_element"

    Given I am on site homepage

    And I should see "Starred Courses" in the ".local_fcl_starred_courses .card-text.content" "css_element"

    Given the following config values are set as admin:
      | name                                       | value |
      | local_fcl_starred_courses_display_starred      | 1     |

    And I reload the page
    And I should not see "Starred Courses" in the ".local_fcl_starred_courses .card-text.content" "css_element"
    Then I should see "Course One" in the ".local_fcl_starred_courses" "css_element"
    Then I should see "Course Two" in the ".local_fcl_starred_courses" "css_element"
    Then I should not see "Course Three" in the ".local_fcl_starred_courses" "css_element"

    Given the following config values are set as admin:
      | name                                       | value |
      | local_fcl_starred_courses_display_starred      | 0     |

    And I reload the page
    And I should not see "Starred Courses" in the ".local_fcl_starred_courses .card-text.content" "css_element"
    Then I should not see "Course One" in the ".local_fcl_starred_courses" "css_element"
    Then I should not see "Course Two" in the ".local_fcl_starred_courses" "css_element"
    Then I should not see "Course Three" in the ".local_fcl_starred_courses" "css_element"

    # Double-check that Display: Off is working for recent courses
    And I should not see "Recent Courses" in the ".local_fcl_starred_courses .card-text.content" "css_element"
    And I am on site homepage
    And I follow "Course One"
    And I follow "Unstar this course"
    And I am on site homepage
    And I follow "Course Two"
    And I follow "Unstar this course"
    Then I should not see "Course One" in the ".local_fcl_starred_courses" "css_element"
    Then I should not see "Course Two" in the ".local_fcl_starred_courses" "css_element"
    Then I should not see "Course Three" in the ".local_fcl_starred_courses" "css_element"

  @javascript
  Scenario: Recent courses
    Given the following "courses" exist:
      | fullname     | shortname   | numsections |
      | Course One   | courseone   | 15          |
      | Course Two   | coursetwo   | 15          |
      | Course Three | coursethree | 15          |
    Given the following config values are set as admin:
      | name                                       | value |
      | local_fcl_starred_courses_display_starred      | 0     |
      | local_fcl_starred_courses_display_recent       | 2     |
      | local_fcl_starred_courses_display_toggle       | 1     |
      | local_fcl_starred_courses_name_length          | 0     |
      | local_fcl_starred_courses_recent_enrolled_only | 0     |
      | local_fcl_starred_courses_recent_limit         | 0     |

    And I log in as "admin"
    And I am on site homepage
    And I turn editing mode on
    And I add the "Starred courses" block
    And I open the "local_fcl_starred_courses" blocks action menu
    And I follow "Configure Starred Courses block"
    And I select "Display throughout the entire site" from the "bui_contexts" singleselect
    And I press "Save changes"

    And I am on site homepage
    And I follow "Course One"
    And I am on site homepage
    And I follow "Course Two"
    And I am on site homepage
    And I follow "Course Three"

    Then I should see "Course One" in the ".local_fcl_starred_courses" "css_element"
    Then I should see "Course Two" in the ".local_fcl_starred_courses" "css_element"
    Then I should see "Course Three" in the ".local_fcl_starred_courses" "css_element"

    And I should see "Recent Courses" in the ".local_fcl_starred_courses .card-text.content" "css_element"

    Given the following config values are set as admin:
      | name                                       | value |
      | local_fcl_starred_courses_display_recent       | 1     |

    And I reload the page
    And I should not see "Recent Courses" in the ".local_fcl_starred_courses .card-text.content" "css_element"
    Then I should see "Course One" in the ".local_fcl_starred_courses" "css_element"
    Then I should see "Course Two" in the ".local_fcl_starred_courses" "css_element"
    Then I should see "Course Three" in the ".local_fcl_starred_courses" "css_element"

    Given the following config values are set as admin:
      | name                                       | value |
      | local_fcl_starred_courses_display_recent       | 0     |

    And I reload the page
    And I should not see "Recent Courses" in the ".local_fcl_starred_courses .card-text.content" "css_element"
    Then I should not see "Course One" in the ".local_fcl_starred_courses" "css_element"
    Then I should not see "Course Two" in the ".local_fcl_starred_courses" "css_element"
    Then I should not see "Course Three" in the ".local_fcl_starred_courses" "css_element"

    # Double-check that Display: Off is working for starred courses
    And I am on site homepage
    And I follow "Course One"
    And I follow "Star this course"
    And I am on site homepage
    And I follow "Course Two"
    And I follow "Star this course"
    And I am on site homepage
    And I follow "Course Three"
    And I follow "Star this course"
    And I should not see "Starred Courses" in the ".local_fcl_starred_courses .card-text.content" "css_element"
    Then I should not see "Course One" in the ".local_fcl_starred_courses" "css_element"
    Then I should not see "Course Two" in the ".local_fcl_starred_courses" "css_element"
    Then I should not see "Course Three" in the ".local_fcl_starred_courses" "css_element"

  @javascript
  Scenario: Course name truncation
    Given the following "courses" exist:
      | fullname                                                    | shortname | numsections |
      | A Course With A Name That Is Simply Excessive In Its Length | courseone | 15          |
      | abcdefghijk mnopqrstuvwxyz                                  | coursetwo | 15          |
    Given the following config values are set as admin:
      | name                                       | value |
      | local_fcl_starred_courses_display_starred      | 1     |
      | local_fcl_starred_courses_display_recent       | 0     |
      | local_fcl_starred_courses_display_toggle       | 1     |
      | local_fcl_starred_courses_name_length          | 0     |
      | local_fcl_starred_courses_recent_enrolled_only | 0     |
      | local_fcl_starred_courses_recent_limit         | 0     |

    And I log in as "admin"
    And I am on site homepage
    And I turn editing mode on
    And I add the "Starred courses" block
    And I open the "local_fcl_starred_courses" blocks action menu
    And I follow "Configure Starred Courses block"
    And I select "Display throughout the entire site" from the "bui_contexts" singleselect
    And I press "Save changes"

    And I am on site homepage
    And I follow "A Course With A Name That Is Simply Excessive In Its Length"
    And I follow "Star this course"
    And I am on site homepage
    And I follow "abcdefghijk mnopqrstuvwxyz"
    And I follow "Star this course"

    And I am on site homepage
    Then I should see "A Course With A Name That Is Simply Excessive In Its Length" in the ".local_fcl_starred_courses" "css_element"
    And I should see "abcdefghijk mnopqrstuvwxyz" in the ".local_fcl_starred_courses" "css_element"

    Given the following config values are set as admin:
      | name                              | value |
      | local_fcl_starred_courses_name_length | 15    |

    When I reload the page
    Then I should see "A Course Wit..." in the ".local_fcl_starred_courses" "css_element"
    Then I should see "abcdefghijk..." in the ".local_fcl_starred_courses" "css_element"

    Given the following config values are set as admin:
      | name                              | value |
      | local_fcl_starred_courses_name_length | 30    |

    When I reload the page
    Then I should see "A Course With A Name That I..." in the ".local_fcl_starred_courses" "css_element"
    Then I should see "abcdefghijk mnopqrstuvwxyz" in the ".local_fcl_starred_courses" "css_element"
