<?php
$config = array (	
		//应用ID,您的APPID。
		'app_id' => "2016101100661556",

		//商户私钥
		'merchant_private_key' => "MIIEowIBAAKCAQEAqxbbcMkscfReRfUsLE6Utf3AF+ngy/s4Uofsr9/eQHz8zsGy2Vo/i2juIf5W0JJhp8gssX32pIuDc52964bdbcMMhvWOmQFJIF7YSgy/W0knqgWeaN8Ubr/wNGjtlRNdHLIegt1KBtMOrLsl5OLw/uTya7iuiEE/gRid/cEh704M6YXArg8Kuntzzxu6pFO8usywTixIvfRZw34+d+NKdNow8WhtqUlC0OwtVwwpQf6/PqoD1A7l88Hbr+hshHbu4mDQn/ZoSYxuvwRyM+m3jbA7LHG5202eSq0UlGFQtyus44XVudgu3bO51oKRpwjgmE7jRbDNe5rgFIgHtTqHdwIDAQABAoIBAQCF5CVnZoh5xZvhc7VWF0kaA7NJA6cA+2FgdS8tlC0Cms3doIiuwInqN/vkbn7SSzxRab5QSRu0OdptqIzwvWKce4BaPeGSrAbmZlMt4DwA3IdF74/A0pPS+DKrUVJc0AKWam6mSzebj6B0XSGStmeTkuiElMtBpo5kITfDVlmQRGSFq331YfO8xuh0sNowp4jCtezTi8QHsnIRV80txKFvjnOYaT4OP7n8p+kpoxNIjDQuuQ9xj5VHlM76oTH4t3pddWkKtHRuMiZ2URitMT4P7dYyDO8gAT94t727OI5u2Zmg/xZxoPR+GZVM0/BxOodjHj+qrckC7K8LV1u/2NLBAoGBAN3r5U2KZ2brXYOztrF8vA3nJ39HIEPA8ymkByhXQZ+S6chTV7J0/lCIURGlopiSsYTjlPOR2QgNk5YzSbigQLDR7GolSw8ziv/bC/geqJwnUjSHoZkdI8DrgKTL1j1ve+1RUYbFeQ6yZksq8Y7B4pIsAUoVP9FmQ7ZGXDfhOGSVAoGBAMVcqdDGItKTNOmKUUZ7Uepu3XUF90HdyTIFTQGTL4H40gFSF3zBD9jJGHawWl3fvbDlvN1A0VNNMXke8KipRBVPRJHshrH/+HcdMciOhCzshGjLsMaiDMwckm3aFOj+5Dc7gn8wJt8qZMZyf5MuaKtQrrKUuMNMI0haTFxFT4zbAoGAS7H0ytgUoQRTJ2MbQ7r6Ifvgewd1t+aOinuKfXYVyipAV7YlyZciT7HPhSdsKIKQznUaD2KGFrsaxjbERJdUuXtBGouR6KN6G/9JO96pQGohHg3NTv6jfWBWxt9IOjhWmwILvt6IhjzPq4AAWONFNvqPjgdldzVcj0W8msrVg2kCgYBtUByyiPvCnExDShwoKKe/bDZ22Z4QulH0xaDYTXiTyYgvuRNPQvOPBBrrqlPzCLjdIPIRrhQCyo+rYWq0UERodSYqmNImBvvMpbvsNJua8kmIbcF00065Qt4LwC2yu3MV8H0gC0CMfMOicsqcb6kDskWAngUUDrjAG1uOA8nC3wKBgCkPYyIDbF796alfd3N3bobc0OaNe/rZxyK9wN7WFoAAfTjuOQWxczn7al+bF2ySG7YiA1D3uiVeXOkJr00zKu+WnCNIdhQgbxK/AiNfhI+c1qZlU0SNTmPEb9KrMP2MVgBFb9T/T/roiDXZxc8ywSqQ5rPDvkfM+khL1p6EEStr",
		
		//异步通知地址
		'notify_url' => "http://shop34.com/index/pay/notifyurl.html",
		
		//同步跳转
		'return_url' => "http://shop34.com/index/pay/returnurl.html",

		//编码格式
		'charset' => "UTF-8",

		//签名方式
		'sign_type'=>"RSA2",

		//支付宝网关
		'gatewayUrl' => "https://openapi.alipaydev.com/gateway.do",

		//支付宝公钥,查看地址：https://openhome.alipay.com/platform/keyManage.htm 对应APPID下的支付宝公钥。
		'alipay_public_key' => "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAofJxNagWevZ5ZnbOsj3NiRfFo4R6aBYZD6oJO88P1JCGhYmOc3oWmiUwv8wX/3Lra/Pe2kpLz+0Pl70JVOMUbWQTRD4RLXH8btWWqQP9jMo6fVJfft85pP90XrEb84gytO2M5D8/Vfa/TAfeqLh4MfR+z1SngyqGojatNwBBQHwgJOICNlKTQoxgDzPBy6TDZgQqkUB3iJk0nHY49u5wOgGZQrpbc2i1jqgu+23ALYxkFe44+0ebBi0pJI+s4UH0wMBHbTqEUzBF5dxzsFhCXW33sG6uXzjUN7H+x6fuMp/6uyzXKftDeVyDze1uB+a0Ua39zBAerYvUITmZ/u520QIDAQAB",
);