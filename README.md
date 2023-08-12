## Assessments application
The task is to implement the business domain logic associated with the evaluation
process based on the description below.
The main purpose of it is to demonstrate your programming and modeling skills.
It is not required to finish the task. Feel free to use as much time as you need.
Implementation without using any framework nor database is acceptable.
It is required to prepare a set of automated tests (PHPUnit) to verify the
correctness of the implementation in accordance with business requirements.
Tests must be runnable and green.
The task should be implemented in PHP language version min. 8.1.
If you plan to use a Framework or database you are limited to Symfony 5.4 and
PostgreSQL 13.

codete.com

Consider following requirements:
1. The system allows the recording of assessments carried out with their
   evaluations.
2. The evaluation is carried out by the Supervisor.
3. Assessment is carried out in the indicated Standard.
4. Clients can have multiple assessments in different standards.
5. The Client being evaluated must have an active contract with the Supervisor.
6. The Supervisor must have authority for the standard on the day evaluation
   takes place.
7. Upon completion of evaluation the assessment can have positive or negative
   ratings.
8. The assessment has an expiration date of 365 days counting from the day
   evaluation took place. After it is exceeded, the assessment expires.
9. It is possible to lock the assessment by suspension or withdrawn.
10. Suspended assessment can be unlocked.
11. Suspended assessment may be withdrawn.
12. Withdrawned assessment cannot be unlocked nor lock cannot be changed into
    suspension.
13. Expired assessment cannot be locked.
14. It is not possible to lock an assessment that is currently locked, it is necessary to
    unlock it in advance. Only changing Suspension into withdrawn is allowed.
15. Assessment lock should contain descriptive information about the operation
    performed.
16. Conducting further evaluation is carried out under the same standard. This
    means that it is possible to replace an assessment obtained in the standard X by
    obtaining an assessment in the same standard X
17. If Client has an active assessment, the newly obtained assessment replaces the
    current one.
18. Subsequent evaluation may be conducted after a period of not less than 180
    days for evaluation completed with a positive result and 30 days for evaluation
    completed with a negative result