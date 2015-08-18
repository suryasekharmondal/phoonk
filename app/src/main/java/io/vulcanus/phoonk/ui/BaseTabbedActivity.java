/*
 * Copyright 2015 Abhishek Dabholkar
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

package io.vulcanus.phoonk.ui;

import android.os.Bundle;
import android.support.design.widget.TabLayout;
import android.support.v4.view.ViewPager;

import io.vulcanus.phoonk.R;

/**
 * Provides common tab functionality across required activities.
 */
public class BaseTabbedActivity extends BaseNavDrawerActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
    }

    /**
     * Sets up tabs when requested by child activities.
     *
     * @param viewPager View pager that is supposed to be bound to respective tabs.
     */
    protected void setupTabs(ViewPager viewPager) {
        TabLayout tabLayout = (TabLayout) findViewById(R.id.tabs);
    }

}
