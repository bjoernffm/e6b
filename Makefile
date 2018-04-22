help:
	@echo "Please use \`make <target>' where <target> is one of"
	@echo "  test           to perform unit tests.  Provide TEST to perform a specific test."

coverage:
	vendor/bin/phpunit --coverage-html=artifacts/coverage

clean:
	rm -rf artifacts/*

test:
	vendor/bin/phpunit