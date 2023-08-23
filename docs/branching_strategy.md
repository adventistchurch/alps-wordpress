## ALPS WordPress Theme Support branches Guide

### Branching name convention

In this repo we support a few **`TYPES`** folders of the branches:
- feat     - feature branch with new functional;
- fix      - fix branches for some fixes or hot fixes;
- docs     - branches for updating docs;
- style    - after removing need styles inside theme if we need to update or fix style;
- refactor - refactoring branches;
- build    - branches for fixing build issues.
- release  - put branches to this folder **ONLY for release before running `project:set-version` command and push changes**

NOTE: use release branches after all need changes were tested by responsible people and were pushed to `v3.1` branch. 
After this we need run `project:set-version` command and push changes to GitHub. Release will start automaticaly.

### Proposing

We propose to put each request/task/bug to special folder. It looks like this: 
- `feat/{number_of_issue-description}`. ==> `Example: feat/123-Test_report_issue`

### Commit message convention

Using Conventional commits messages we are expecting to get more readable context for the reader.
Our example:
```agsl
<folder_of_branch>[optional scope]: <subject>

[optional body]

[footer]
```

#### Scope
The scope provides additional contextual information.

#### Body
The body should include the need changes which were done.

#### Footer
The footer should contain any information about task: number, name.

Example:
```agsl
feat: Add some new functionality (#) |  50 character limit for line (type, scope and subject).
                                     |
 
Changes:                             | 200 character limit for body.
 - was added something 1;            |                          
 - was added something 2;            |
 - was added something 3;            |

#123-Number_of_ticket                |_ 50 character limit for footer
```


