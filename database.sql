CREATE TABLE `activity` (
  `id` int(11) NOT NULL,
  `txid` varchar(255) DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `uid` int(11) DEFAULT NULL,
  `u_field_1` varchar(255) DEFAULT NULL,
  `u_field_2` varchar(255) DEFAULT NULL,
  `u_field_3` varchar(255) DEFAULT NULL,
  `u_field_4` varchar(255) DEFAULT NULL,
  `u_field_5` varchar(255) DEFAULT NULL,
  `amount` varchar(255) DEFAULT NULL,
  `currency` varchar(255) DEFAULT NULL,
  `deposit_via` int(11) DEFAULT NULL,
  `withdrawal_via` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created` int(11) DEFAULT NULL,
  `updated` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `admin_earnings` (
  `id` int(11) NOT NULL,
  `amount` varchar(255) DEFAULT NULL,
  `currency` varchar(255) DEFAULT NULL,
  `created` int(11) DEFAULT NULL,
  `updated` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `admin_logs` (
  `id` int(11) NOT NULL,
  `type` int(11) DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  `u_field_1` varchar(255) DEFAULT NULL,
  `u_field_2` varchar(255) DEFAULT NULL,
  `u_field_3` varchar(255) DEFAULT NULL,
  `u_field_4` varchar(255) DEFAULT NULL,
  `u_field_5` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `bonus_logs` (
  `id` int(11) NOT NULL,
  `uid` int(11) DEFAULT NULL,
  `user_email` varchar(255) DEFAULT NULL,
  `from_who` varchar(255) DEFAULT NULL,
  `commission` varchar(255) DEFAULT NULL,
  `currency` varchar(255) DEFAULT NULL,
  `date` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `country` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `currency` (
  `id` int(11) NOT NULL,
  `currency` varchar(255) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `default_curr` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `deposits` (
  `id` int(11) NOT NULL,
  `uid` int(11) DEFAULT NULL,
  `txid` varchar(255) DEFAULT NULL,
  `method` int(11) DEFAULT NULL,
  `amount` varchar(255) DEFAULT NULL,
  `currency` varchar(255) DEFAULT NULL,
  `requested_on` int(11) DEFAULT NULL,
  `processed_on` int(11) DEFAULT NULL,
  `gateway_txid` varchar(255) DEFAULT NULL,
  `reference_number` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `gateways` (
  `id` int(11) NOT NULL,
  `type` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `currency` varchar(255) DEFAULT NULL,
  `reserve` varchar(255) DEFAULT NULL,
  `min_amount` varchar(255) DEFAULT NULL,
  `max_amount` varchar(255) DEFAULT NULL,
  `exchange_type` int(11) DEFAULT NULL,
  `include_fee` int(11) DEFAULT NULL,
  `extra_fee` varchar(255) DEFAULT NULL,
  `fee` varchar(255) DEFAULT NULL,
  `allow_send` int(11) DEFAULT NULL,
  `allow_receive` int(11) DEFAULT NULL,
  `default_send` int(11) DEFAULT NULL,
  `default_receive` int(11) DEFAULT NULL,
  `allow_payouts` int(11) DEFAULT NULL,
  `a_field_1` varchar(255) DEFAULT NULL,
  `a_field_2` varchar(255) DEFAULT NULL,
  `a_field_3` varchar(255) DEFAULT NULL,
  `a_field_4` varchar(255) DEFAULT NULL,
  `a_field_5` varchar(255) DEFAULT NULL,
  `a_field_6` varchar(255) DEFAULT NULL,
  `a_field_7` varchar(255) DEFAULT NULL,
  `a_field_8` varchar(255) DEFAULT NULL,
  `a_field_9` varchar(255) DEFAULT NULL,
  `a_field_10` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `external_gateway` int(11) NOT NULL DEFAULT '0',
  `external_icon` text,
  `process_type` int(11) DEFAULT NULL,
  `process_time` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `gateways_fields` (
  `id` int(11) NOT NULL,
  `gateway_id` int(11) DEFAULT NULL,
  `field_name` varchar(255) DEFAULT NULL,
  `field_number` int(11) DEFAULT NULL,
  `field_value` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `levels` (
  `id` int(11) NOT NULL,
  `mem_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fix_com` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `per_com` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `membership_log` (
  `id` int(11) NOT NULL,
  `txid` varchar(255) DEFAULT NULL,
  `plan` int(11) DEFAULT NULL,
  `uid` int(11) DEFAULT NULL,
  `amount` varchar(255) DEFAULT NULL,
  `currency` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created` varchar(255) DEFAULT NULL,
  `date` varchar(255) DEFAULT NULL,
  `end_date` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `offerwalls_logs` (
  `id` int(11) NOT NULL,
  `uid` int(11) DEFAULT NULL,
  `tid` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `company` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reward` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `signature` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ip` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_created` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `campaign_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `campaign_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `action` int(11) DEFAULT NULL,
  `txid` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `processed_on` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `prefix` varchar(255) DEFAULT NULL,
  `content` text,
  `created` int(11) DEFAULT NULL,
  `updated` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `referral_membership` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `limits` int(11) DEFAULT NULL,
  `ref_com_fix` varchar(255) DEFAULT NULL,
  `ref_com_per` int(11) DEFAULT NULL,
  `price` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `duration` int(11) DEFAULT NULL,
  `levels_allow` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `reward` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reward` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reward_limit` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `reward_log` (
  `id` int(11) NOT NULL,
  `uid` int(11) DEFAULT NULL,
  `reward_id` int(11) DEFAULT NULL,
  `txid` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `amount` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `keywords` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `infoemail` varchar(255) DEFAULT NULL,
  `supportemail` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `default_language` varchar(255) DEFAULT NULL,
  `default_template` varchar(255) DEFAULT NULL,
  `default_currency` varchar(255) DEFAULT NULL,
  `logo` text,
  `favicon` text,
  `white_logo` text,
  `require_email_verify` int(11) DEFAULT NULL,
  `require_document_verify` int(11) DEFAULT NULL,
  `limit_maxamount_sent` int(11) DEFAULT NULL,
  `limit_maxtxs_sent` int(11) DEFAULT NULL,
  `payfee_type` int(11) DEFAULT NULL,
  `payfee_fixed` varchar(255) DEFAULT NULL,
  `payfee_percentage` int(11) DEFAULT NULL,
  `enable_recaptcha` int(11) DEFAULT NULL,
  `recaptcha_publickey` varchar(255) DEFAULT NULL,
  `recaptcha_privatekey` varchar(255) DEFAULT NULL,
  `enable_curcnv` int(11) DEFAULT NULL,
  `curcnv_fee_percentage` int(11) DEFAULT NULL,
  `ref_com` int(11) DEFAULT NULL,
  `live_chat_code` text,
  `google_analytics_code` text,
  `merchant_fixed` varchar(255) DEFAULT NULL,
  `merchant_percentage` int(11) DEFAULT NULL,
  `wannads_api` varchar(255) DEFAULT NULL,
  `wannads_secret` varchar(255) DEFAULT NULL,
  `bitlabs_api` varchar(255) DEFAULT NULL,
  `bitlabs_secret` varchar(255) DEFAULT NULL,
  `cpxresearch_api` varchar(255) DEFAULT NULL,
  `cpxresearch_secret` varchar(255) DEFAULT NULL,
  `monlix_api` varchar(255) DEFAULT NULL,
  `monlix_secret` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `support` (
  `id` int(11) NOT NULL,
  `hash` varchar(255) DEFAULT NULL,
  `sender` int(11) DEFAULT NULL,
  `recipient` int(11) DEFAULT NULL,
  `txid` varchar(255) DEFAULT '0',
  `amount` varchar(255) DEFAULT '0',
  `currency` varchar(255) DEFAULT '0',
  `escalate_review` int(11) DEFAULT NULL,
  `escalate_message` text,
  `escalate_issued_by` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created` int(11) DEFAULT NULL,
  `updated` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `support_messages` (
  `id` int(11) NOT NULL,
  `uid` int(11) DEFAULT NULL,
  `dispute_id` int(11) DEFAULT NULL,
  `comment` text,
  `attachment` text,
  `time` int(11) DEFAULT NULL,
  `is_admin` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `txid` varchar(255) DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `sender` int(11) DEFAULT NULL,
  `recipient` int(11) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `amount` varchar(255) DEFAULT NULL,
  `currency` varchar(255) DEFAULT NULL,
  `fee` varchar(255) DEFAULT NULL,
  `deposit_via` int(11) DEFAULT NULL,
  `withdrawal_via` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created` int(11) DEFAULT NULL,
  `updated` int(11) DEFAULT NULL,
  `item_id` varchar(255) DEFAULT NULL,
  `item_name` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `password_recovery` varchar(255) DEFAULT NULL,
  `document_verified` int(11) DEFAULT NULL,
  `email_verified` int(11) DEFAULT NULL,
  `email_hash` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `account_type` int(11) DEFAULT NULL,
  `account_level` int(11) DEFAULT NULL,
  `account_user` varchar(255) DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `last_login` int(11) DEFAULT NULL,
  `signup_time` int(11) DEFAULT NULL,
  `2fa_auth` int(11) DEFAULT NULL,
  `2fa_auth_login` int(11) DEFAULT NULL,
  `2fa_auth_send` int(11) DEFAULT NULL,
  `2fa_auth_withdrawal` int(11) DEFAULT NULL,
  `googlecode` varchar(255) DEFAULT NULL,
  `wallet_passphrase` varchar(255) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `business_name` varchar(255) DEFAULT NULL,
  `business_website` varchar(255) DEFAULT NULL,
  `business_country` varchar(255) DEFAULT NULL,
  `business_description` text,
  `business_category` varchar(255) DEFAULT NULL,
  `business_who_pay_fee` int(11) DEFAULT NULL,
  `merchant_api_key` varchar(255) DEFAULT NULL,
  `business_reject` text,
  `business_status` int(11) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `province` varchar(255) DEFAULT NULL,
  `zip_code` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `birthday_date` varchar(255) DEFAULT NULL,
  `ref1` int(11) DEFAULT NULL,
  `ref2` int(11) DEFAULT NULL,
  `ref3` int(11) DEFAULT NULL,
  `ref4` int(11) DEFAULT NULL,
  `ref5` int(11) DEFAULT NULL,
  `ref6` int(11) DEFAULT NULL,
  `ref7` int(11) DEFAULT NULL,
  `ref8` int(11) DEFAULT NULL,
  `ref9` int(11) DEFAULT NULL,
  `ref10` int(11) DEFAULT NULL,
  `membership` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE `users_documents` (
  `id` int(11) NOT NULL,
  `uid` int(11) DEFAULT NULL,
  `document_type` int(11) DEFAULT NULL,
  `document_path` text,
  `uploaded` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `u_field_1` varchar(255) DEFAULT NULL,
  `u_field_2` varchar(255) DEFAULT NULL,
  `u_field_3` varchar(255) DEFAULT NULL,
  `u_field_4` varchar(255) DEFAULT NULL,
  `u_field_5` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE `users_logs` (
  `id` int(11) NOT NULL,
  `uid` int(11) DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  `u_field_1` varchar(255) DEFAULT NULL,
  `u_field_2` varchar(255) DEFAULT NULL,
  `u_field_3` varchar(255) DEFAULT NULL,
  `u_field_4` varchar(255) DEFAULT NULL,
  `u_field_5` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE `users_wallets` (
  `id` int(11) NOT NULL,
  `uid` int(11) DEFAULT NULL,
  `amount` varchar(255) DEFAULT NULL,
  `currency` varchar(5) DEFAULT NULL,
  `updated` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE `withdrawals` (
  `id` int(11) NOT NULL,
  `uid` int(11) DEFAULT NULL,
  `txid` varchar(255) DEFAULT NULL,
  `method` int(11) DEFAULT NULL,
  `amount` varchar(255) DEFAULT NULL,
  `fee` varchar(255) DEFAULT NULL,
  `currency` varchar(255) DEFAULT NULL,
  `requested_on` int(11) DEFAULT NULL,
  `processed_on` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `gateway_txid` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE `withdrawals_values` (
  `id` int(11) NOT NULL,
  `uid` int(11) DEFAULT NULL,
  `withdrawal_id` int(11) DEFAULT NULL,
  `gateway_id` int(11) DEFAULT NULL,
  `field_id` int(11) DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
ALTER TABLE `activity`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `admin_earnings`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `admin_logs`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `bonus_logs`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `country`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `currency`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `deposits`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `gateways`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `gateways_fields`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `levels`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `membership_log`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `offerwalls_logs`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `referral_membership`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `reward`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `reward_log`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `support`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `support_messages`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `users_documents`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `users_logs`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `users_wallets`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `withdrawals`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `withdrawals_values`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `activity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `admin_earnings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `admin_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `bonus_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `country`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `currency`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `deposits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `gateways`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `gateways_fields`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `levels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `membership_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `offerwalls_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `referral_membership`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `reward`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `reward_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `support`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;ALTER TABLE `support_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `users_documents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `users_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `users_wallets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `withdrawals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `withdrawals_values`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;