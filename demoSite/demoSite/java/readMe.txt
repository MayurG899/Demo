This is new file we are adding
Also 

Git Help ::

1. git checkout -b <newBranchName> <Source Branch> - to create new branchon local
2. git checkout <branch> 			   - to switch on another branch

3. git pull 					   - pull all changes in all branch (also helps fetch meta data of newly created branch)
4. git pull origin <branch>		           - pull changes in specific branh

5. git clone repository

6. git diff <filePath/fileName>                    - specific file changes against repo/branch
7. git add <file>				   - add file to commit
8. git commit					   - commit all changes to local
9. git push -u origin <branch>			   - creates and links new branch to remote branch (only for first push after creatinglocal branch)
10. git push origin <branch>			   - pushing local commits to remote banch

11. git log -number 				   - (last number of commits)
12. git rebase <commitId>			   - specific commmit head set and only changes tillspecified commit will be reflected in branch
13. git revert <commitId>			   - changes/commits will be reverted till specified commit

14. git stash save 'message'			   - 
15. git stash list 
stash{0}
stash{1}
stash{2}
16. git stash apply stash{0}
17. git clear

18. git branch -m newBranchName 		   - current local branch name change
19. git branch -d branchName			   - deletes branch (provided you are on some other branch)